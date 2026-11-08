<?php

namespace Tests\Feature;

use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GrowlyticsStreamCommandTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.growlytics.stream_url' => 'https://stream.example.test/listings?token=secret',
            'services.growlytics.retry_delay' => 0,
            'services.growlytics.max_retry_delay' => 0,
        ]);
    }

    /**
     * @param  array<string, mixed>|string  $payload
     */
    protected function listingEvent(array|string $payload): string
    {
        $json = is_array($payload) ? json_encode($payload) : $payload;

        return "id: sse-1\nevent: message\ndata: {$json}\n\n";
    }

    public function test_ingests_listings_from_a_single_connection_cycle(): void
    {
        $body = ": heartbeat\n\n"
            .$this->listingEvent([
                'id' => '8398863',
                'side' => 'sell',
                'item' => 'Vending Machine',
                'priceWl' => 10,
                'server' => 'The Lost Nemo!',
                'world' => 'MICAX',
                'worldVerified' => false,
                'postedAt' => '2026-11-08T01:36:37.199Z',
            ])
            ."data: not-json\n\n"
            .$this->listingEvent([
                'id' => '8398864',
                'side' => 'buy',
                'item' => 'vending   machine',
                'priceWl' => 5,
                'postedAt' => '2026-11-08T01:37:00.000Z',
            ]);

        Http::fake([
            '*' => Http::response($body, 200, ['Content-Type' => 'text/event-stream']),
        ]);

        $this->artisan('growlytics:stream', ['--once' => true])
            ->expectsOutputToContain('[Growlytics] Connecting to SSE stream...')
            ->expectsOutputToContain('[Growlytics] Connected.')
            ->expectsOutputToContain('[Growlytics] Connection lost. Reconnecting...')
            ->assertSuccessful();

        $this->assertSame(2, Listing::query()->count());
        $this->assertSame(
            ['sell', 'buy'],
            Listing::query()->orderBy('external_id')->pluck('side')->all(),
        );
    }

    public function test_survives_a_failed_connection(): void
    {
        Http::fake([
            '*' => Http::failedConnection(),
        ]);

        $this->artisan('growlytics:stream', ['--once' => true])
            ->expectsOutputToContain('[Growlytics] Connection failed. Reconnecting...')
            ->assertSuccessful();

        $this->assertSame(0, Listing::query()->count());
    }

    public function test_stops_on_permanent_authorization_errors(): void
    {
        Http::fake([
            '*' => Http::response('unauthorized', 401),
        ]);

        $this->artisan('growlytics:stream')
            ->expectsOutputToContain('[Growlytics] Endpoint returned HTTP 401; not retrying.')
            ->assertFailed();

        $this->assertSame(0, Listing::query()->count());
    }

    public function test_fails_when_the_stream_url_is_not_configured(): void
    {
        config(['services.growlytics.stream_url' => null]);

        $this->artisan('growlytics:stream')
            ->expectsOutputToContain('[Growlytics] GROWLYTICS_STREAM_URL is not configured')
            ->assertFailed();
    }
}
