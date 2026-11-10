<?php

namespace App\Console\Commands;

use App\Services\ListingIngestService;
use App\Services\SseEvent;
use App\Services\SseParser;
use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

#[Signature('growlytics:stream {--once : Process a single connection cycle (success or failure) then exit, useful for debugging}')]
#[Description('Consume the Growtopia SSE stream and persist marketplace listings')]
class StreamGrowtopiaListings extends Command
{
    /**
     * Bytes read from the stream per iteration.
     */
    protected const READ_CHUNK_BYTES = 8192;

    /**
     * HTTP statuses that indicate a permanent endpoint problem; the command
     * stops instead of hot-retrying.
     */
    protected const FATAL_HTTP_STATUSES = [401, 403, 404];

    protected bool $shouldExit = false;

    protected ?string $lastEventId = null;

    protected ?int $retryHintMs = null;

    protected ListingIngestService $ingestService;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $streamUrl = config('services.growlytics.stream_url');

        if (! is_string($streamUrl) || ! Str::startsWith($streamUrl, ['http://', 'https://'])) {
            $this->error('[Growlytics] GROWLYTICS_STREAM_URL is not configured or is not a valid HTTP(S) URL.');

            return static::FAILURE;
        }

        $this->registerSignalHandlers();
        $this->ingestService = new ListingIngestService($this->listingReporter());

        Log::info('Growlytics: SSE listener started.', ['url' => $this->safeUrl($streamUrl)]);

        $attempt = 0;

        while (! $this->shouldExit) {
            $this->info('[Growlytics] Connecting to SSE stream...');

            try {
                $response = $this->openConnection($streamUrl);
            } catch (ConnectionException|GuzzleException $exception) {
                $this->handleConnectionFailure($exception, $attempt++, $streamUrl);

                if ((bool) $this->option('once') || $this->shouldExit) {
                    break;
                }

                $this->sleepWithBackoff($attempt++);

                continue;
            }

            if (! $this->isSuccessfulStreamResponse($response, $streamUrl)) {
                $this->closeResponse($response);

                if (in_array($response->status(), static::FATAL_HTTP_STATUSES, true)) {
                    $this->error("[Growlytics] Endpoint returned HTTP {$response->status()}; not retrying.");

                    Log::error('Growlytics: permanent HTTP error from SSE endpoint.', [
                        'status' => $response->status(),
                        'url' => $this->safeUrl($streamUrl),
                    ]);

                    return static::FAILURE;
                }

                $this->sleepWithBackoff($attempt++);

                if ((bool) $this->option('once') || $this->shouldExit) {
                    break;
                }

                continue;
            }

            $this->info('[Growlytics] Connected.');
            Log::info('Growlytics: SSE stream connected.');
            $attempt = 0;

            $this->consumeResponseSafely($response);

            $this->closeResponse($response);

            if ($this->shouldExit) {
                break;
            }

            $this->warn('[Growlytics] Connection lost. Reconnecting...');
            Log::warning('Growlytics: SSE stream disconnected, reconnecting.', [
                'last_event_id' => $this->lastEventId,
            ]);

            if ((bool) $this->option('once')) {
                break;
            }

            $this->sleepWithBackoff($attempt++);
        }

        Log::info('Growlytics: SSE listener stopped.', [
            'last_event_id' => $this->lastEventId,
        ]);

        $this->info('[Growlytics] Stream listener stopped.');

        return static::SUCCESS;
    }

    /**
     * Open the long-lived SSE connection. The overall HTTP timeout is disabled
     * on purpose: the response is read incrementally, and stream inactivity is
     * handled by the read timeout instead.
     *
     * @throws ConnectionException|GuzzleException
     */
    protected function openConnection(string $streamUrl): Response
    {
        $request = Http::accept('text/event-stream')
            ->withOptions([
                'stream' => true,
                'timeout' => 0,
                'connect_timeout' => (float) config('services.growlytics.connect_timeout', 15),
                'read_timeout' => (float) config('services.growlytics.read_timeout', 60),
                'http_errors' => false,
            ]);

        if ($this->lastEventId !== null) {
            // Best effort resume; the source may ignore this header and replay
            // nothing, in which case events posted during downtime are lost.
            $request = $request->withHeaders(['Last-Event-ID' => $this->lastEventId]);
        }

        return $request->get($streamUrl);
    }

    /**
     * Read the response body incrementally, parsing complete SSE events as
     * they arrive. Malformed payloads and database failures are logged and
     * skipped so the stream never terminates because of a single bad event.
     */
    protected function consumeResponse(Response $response): void
    {
        $body = $response->toPsrResponse()->getBody();

        $parser = new SseParser(
            maxEventSize: (int) config('services.growlytics.max_event_size', 65536),
            onDrop: fn () => Log::warning('Growlytics: oversized SSE event dropped.'),
        );

        while (! $this->shouldExit && ! $body->eof()) {
            $chunk = $body->read(static::READ_CHUNK_BYTES);

            if ($chunk === '') {
                // Defensive: avoid a busy loop if read() returns empty early.
                usleep(50_000);

                continue;
            }

            foreach ($parser->feed($chunk) as $event) {
                $this->handleEvent($event);
            }
        }
    }

    /**
     * Handle one complete SSE event. Note that the SSE "id:" field is only
     * used for Last-Event-ID resume; the listing's external_id comes from the
     * JSON payload itself.
     */
    protected function handleEvent(SseEvent $event): void
    {
        if ($event->id !== null) {
            $this->lastEventId = $event->id;
        }

        if ($event->retry !== null) {
            $this->retryHintMs = $event->retry;
        }

        $payload = json_decode($event->data, true);

        if (! is_array($payload)) {
            // Not every SSE event carries a listing (keepalives, etc.).
            return;
        }

        try {
            $this->ingestService->ingest($payload);
        } catch (Throwable) {
            // Already logged with context inside the service; keep streaming.
        }
    }

    /**
     * Build the per-listing console reporter; per-listing output is only
     * written when the console runs with increased verbosity (-v).
     *
     * @return Closure(string $type, array<string, mixed> $context): void
     */
    protected function listingReporter(): Closure
    {
        return function (string $type, array $context): void {
            if (! $this->output->isVerbose()) {
                return;
            }

            match ($type) {
                'saved' => $this->info(sprintf(
                    '[Growlytics] Saved listing #%s - %s - %s WL',
                    $context['external_id'],
                    $context['item'],
                    $context['price_wl'],
                )),
                'duplicate' => $this->line(sprintf(
                    '[Growlytics] Duplicate listing #%s skipped.',
                    $context['external_id'],
                )),
                'rejected' => $this->warn('[Growlytics] Skipped malformed listing: '.implode('; ', $context['errors'])),
                default => null,
            };
        };
    }

    /**
     * Check the response status, warning when the content type looks wrong.
     */
    protected function isSuccessfulStreamResponse(Response $response, string $streamUrl): bool
    {
        $status = $response->status();

        if ($status < 200 || $status >= 300) {
            Log::warning('Growlytics: unexpected HTTP status from SSE endpoint.', [
                'status' => $status,
                'url' => $this->safeUrl($streamUrl),
            ]);

            $this->warn("[Growlytics] Unexpected HTTP status {$status}. Retrying...");

            return false;
        }

        $contentType = (string) $response->header('Content-Type');

        if ($contentType !== '' && ! str_contains($contentType, 'text/event-stream')) {
            Log::warning('Growlytics: SSE endpoint returned an unexpected content type.', [
                'content_type' => $contentType,
            ]);
        }

        return true;
    }

    /**
     * Log a failed connection attempt.
     */
    protected function handleConnectionFailure(Throwable $exception, int $attempt, string $streamUrl): void
    {
        Log::warning('Growlytics: SSE connection failed.', [
            'attempt' => $attempt,
            'url' => $this->safeUrl($streamUrl),
            'exception' => $exception->getMessage(),
        ]);

        $this->warn('[Growlytics] Connection failed. Reconnecting...');
    }

    /**
     * Read errors during consumption are treated like a dropped connection:
     * log them and let the reconnect loop take over.
     */
    protected function consumeResponseSafely(Response $response): void
    {
        try {
            $this->consumeResponse($response);
        } catch (ConnectionException|GuzzleException $exception) {
            Log::warning('Growlytics: SSE stream read failed.', [
                'exception' => $exception->getMessage(),
            ]);
        } catch (Throwable $exception) {
            Log::error('Growlytics: unexpected error while reading SSE stream.', [
                'exception' => $exception::class.': '.$exception->getMessage(),
            ]);
        }
    }

    /**
     * Sleep using bounded exponential backoff with jitter, honoring a server
     * "retry:" hint when present. Sleeps in one-second steps so shutdown
     * signals stay responsive.
     */
    protected function sleepWithBackoff(int $attempt): void
    {
        $base = max(0, (int) config('services.growlytics.retry_delay', 5));
        $maximum = max($base, (int) config('services.growlytics.max_retry_delay', 60));

        $delay = $this->retryHintMs !== null
            ? min($maximum, intdiv($this->retryHintMs, 1000))
            : min($maximum, $base * 2 ** min($attempt, 8));

        $delay = (int) round($delay * (0.75 + (mt_rand() / mt_getrandmax()) * 0.5));

        $remaining = $delay;

        while ($remaining > 0 && ! $this->shouldExit) {
            sleep(1);
            $remaining--;
        }
    }

    /**
     * Close the underlying stream so no sockets leak on early exits.
     */
    protected function closeResponse(Response $response): void
    {
        try {
            $response->toPsrResponse()->getBody()->close();
        } catch (Throwable) {
            // The stream may already be detached; nothing to do.
        }
    }

    /**
     * Register graceful shutdown handlers where PCNTL is available (not on
     * Windows); on other platforms Ctrl+C still terminates the process.
     */
    protected function registerSignalHandlers(): void
    {
        $signals = array_values(array_filter(
            [defined('SIGTERM') ? SIGTERM : null, defined('SIGINT') ? SIGINT : null],
            is_int(...),
        ));

        if ($signals === []) {
            return;
        }

        $this->trap($signals, function (): void {
            $this->shouldExit = true;
            $this->line('[Growlytics] Shutdown signal received.');
        });
    }

    /**
     * URL without its query string, safe to include in logs.
     */
    protected function safeUrl(string $streamUrl): string
    {
        $parts = parse_url($streamUrl);

        if ($parts === false) {
            return '<unparseable>';
        }

        return ($parts['scheme'] ?? 'https').'://'.($parts['host'] ?? '').($parts['path'] ?? '');
    }
}
