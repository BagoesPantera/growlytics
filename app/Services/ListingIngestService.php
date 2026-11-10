<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Listing;
use Closure;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Persists marketplace listings received from the SSE stream.
 *
 * Malformed payloads are logged and skipped (never thrown), so a single bad
 * event cannot take down the stream listener. Duplicate events (same
 * external_id) are detected via the unique constraint and ignored without
 * modifying the stored historical record.
 */
class ListingIngestService
{
    /**
     * Create a new ingestion service.
     *
     * @param  (Closure(string $type, array<string, mixed> $context): void)|null  $onResult
     *                                                                                       Optional observer invoked with "saved", "duplicate" or
     *                                                                                       "rejected" results so callers can surface console output.
     */
    public function __construct(
        protected readonly ?Closure $onResult = null,
    ) {}

    /**
     * Validate and persist a single listing payload.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws Throwable when the database write fails (logged first, then rethrown)
     */
    public function ingest(array $data): void
    {
        $validated = $this->validate($data);

        if ($validated === null) {
            return; // Malformed payload: already logged, skip without crashing.
        }

        try {
            DB::transaction(function () use ($validated): void {
                $item = $this->findOrCreateItem($validated['item_name'], $validated['normalized_name']);

                $attributes = [
                    'external_id' => $validated['external_id'],
                    'item_id' => $item->getKey(),
                    'side' => $validated['side'],
                    'price_wl' => $validated['price_wl'],
                    'server' => $validated['server'],
                    'channel' => $validated['channel'],
                    'world' => $validated['world'],
                    'world_verified' => $validated['world_verified'],
                    'url' => $validated['url'],
                    'posted_at' => $validated['posted_at'],
                ];

                try {
                    $listing = Listing::create($attributes);
                } catch (UniqueConstraintViolationException) {
                    // A concurrent process stored this event first; keep the
                    // original record untouched.
                    Log::info('Growlytics: duplicate listing skipped.', [
                        'external_id' => $validated['external_id'],
                    ]);

                    $this->notifyResult('duplicate', [
                        'external_id' => $validated['external_id'],
                    ]);

                    return;
                }

                Log::debug('Growlytics: listing saved.', [
                    'external_id' => $listing->external_id,
                    'item_id' => $listing->item_id,
                ]);

                $this->notifyResult('saved', [
                    'external_id' => $listing->external_id,
                    'item' => $item->name,
                    'side' => $listing->side,
                    'price_wl' => $listing->price_wl,
                ]);
            });
        } catch (Throwable $exception) {
            // Never silently discard a valid listing: log full context first.
            Log::error('Growlytics: failed to ingest listing.', [
                'external_id' => $validated['external_id'],
                'item' => $validated['item_name'],
                'exception' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    /**
     * Normalize an item name for deduplication: trim, collapse repeated
     * whitespace and lowercase, using Unicode-aware functions.
     */
    public static function normalizeItemName(string $name): string
    {
        $collapsed = preg_replace('/\s+/u', ' ', trim($name));

        return mb_strtolower($collapsed ?? trim($name));
    }

    /**
     * Validate the incoming payload.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>|null validated fields, or null when malformed
     */
    protected function validate(array $data): ?array
    {
        $errors = [];

        $externalId = $this->validatedExternalId(Arr::get($data, 'id'));
        if ($externalId === null) {
            $errors[] = 'id must be a non-empty string or integer (max 64 chars)';
        }

        $side = Arr::get($data, 'side');
        if (! in_array($side, ['buy', 'sell'], true)) {
            $errors[] = 'side must be "buy" or "sell"';
        }

        $itemName = $this->validatedItemName(Arr::get($data, 'item'));
        if ($itemName === null) {
            $errors[] = 'item must be a non-empty string of at most 255 characters';
        }

        $priceWl = $this->validatedPriceWl(Arr::get($data, 'priceWl'));
        if ($priceWl === null) {
            $errors[] = 'priceWl must be a non-negative integer (fractional prices are rejected)';
        }

        $postedAt = $this->validatedPostedAt(Arr::get($data, 'postedAt'));
        if ($postedAt === null) {
            $errors[] = 'postedAt must be a valid ISO 8601 datetime';
        }

        $server = $this->validatedOptionalString(Arr::get($data, 'server'), 255, $errors, 'server');
        $channel = $this->validatedOptionalString(Arr::get($data, 'channel'), 255, $errors, 'channel');
        $world = $this->validatedOptionalString(Arr::get($data, 'world'), 100, $errors, 'world');
        $url = $this->validatedOptionalString(Arr::get($data, 'url'), 65535, $errors, 'url');

        $worldVerified = $this->validatedWorldVerified(Arr::get($data, 'world_verified') ?? Arr::get($data, 'worldVerified'));
        if ($worldVerified === null) {
            $errors[] = 'worldVerified must be a boolean';
        }

        if ($errors !== []) {
            Log::warning('Growlytics: malformed listing payload skipped.', [
                'external_id' => is_scalar($data['id'] ?? null) ? (string) $data['id'] : null,
                'errors' => $errors,
            ]);

            $this->notifyResult('rejected', ['errors' => $errors]);

            return null;
        }

        return [
            'external_id' => $externalId,
            'side' => $side,
            'item_name' => $itemName,
            'normalized_name' => static::normalizeItemName($itemName),
            'price_wl' => $priceWl,
            'server' => $server,
            'channel' => $channel,
            'world' => $world,
            'world_verified' => $worldVerified,
            'url' => $url,
            'posted_at' => $postedAt,
        ];
    }

    protected function validatedExternalId(mixed $value): ?string
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        if (! is_string($value) || $value === '' || strlen($value) > 64) {
            return null;
        }

        return $value;
    }

    protected function validatedItemName(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $trimmed = trim($value);

        if ($trimmed === '' || mb_strlen($trimmed) > 255) {
            return null;
        }

        return $trimmed;
    }

    protected function validatedPriceWl(mixed $value): ?int
    {
        // Integer World Locks only: fractional prices are rejected, never rounded.
        if (is_string($value) && preg_match('/^-?\d+$/', $value) === 1) {
            $value = (int) $value;
        }

        if (! is_int($value) || $value < 0) {
            return null;
        }

        return $value;
    }

    protected function validatedPostedAt(mixed $value): ?Carbon
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return Carbon::parse($value)->utc();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @param  list<string>  $errors
     */
    protected function validatedOptionalString(mixed $value, int $maxLength, array &$errors, string $field): ?string
    {
        if ($value === null) {
            return null;
        }

        if (! is_string($value)) {
            $errors[] = "{$field} must be a string when present";

            return null;
        }

        $trimmed = trim($value);

        if (mb_strlen($trimmed) > $maxLength) {
            $errors[] = "{$field} must not exceed {$maxLength} characters";

            return null;
        }

        return $trimmed === '' ? null : $trimmed;
    }

    protected function validatedWorldVerified(mixed $value): ?bool
    {
        if ($value === null) {
            return false;
        }

        if (is_bool($value)) {
            return $value;
        }

        if (is_int($value) && in_array($value, [0, 1], true)) {
            return (bool) $value;
        }

        return null;
    }

    /**
     * Forward an ingestion result to the optional observer.
     *
     * @param  array<string, mixed>  $context
     */
    protected function notifyResult(string $type, array $context): void
    {
        if ($this->onResult !== null) {
            ($this->onResult)($type, $context);
        }
    }

    /**
     * Find the master record for a normalized item name, creating it on first
     * use. Race-safe: falls back to a lookup if creation hits the unique key.
     */
    protected function findOrCreateItem(string $name, string $normalizedName): Item
    {
        $item = Item::where('normalized_name', $normalizedName)->first();

        if ($item !== null) {
            return $item;
        }

        $maxAttempts = ItemSlugGenerator::DEFAULT_MAX_ATTEMPTS;

        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            $item = Item::where('normalized_name', $normalizedName)->first();

            if ($item !== null) {
                return $item;
            }

            try {
                $slug = ItemSlugGenerator::generateUniqueSlug($name, 1);

                return Item::create([
                    'name' => $name,
                    'normalized_name' => $normalizedName,
                    'slug' => $slug,
                ]);
            } catch (UniqueConstraintViolationException|\RuntimeException) {
                // Either normalized_name or slug collided; loop and re-check.
                continue;
            }
        }

        throw new \RuntimeException('Unable to create item with a unique slug.');
    }
}
