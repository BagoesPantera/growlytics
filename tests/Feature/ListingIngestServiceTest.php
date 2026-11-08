<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Listing;
use App\Services\ListingIngestService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ListingIngestServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    protected function validPayload(array $overrides = []): array
    {
        return array_merge([
            'id' => '8398863',
            'side' => 'sell',
            'item' => 'Vending Machine',
            'priceWl' => 10,
            'server' => 'The Lost Nemo!',
            'channel' => '🔮・buy-sell-crystals',
            'world' => 'MICAX',
            'worldVerified' => false,
            'url' => 'https://discord.com/channels/571992648190263317/742547014197313576/1568801385397489765',
            'postedAt' => '2026-11-08T01:36:37.199Z',
        ], $overrides);
    }

    public function test_creates_a_new_item_and_listing(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload());

        $item = Item::query()->sole();
        $this->assertSame('Vending Machine', $item->name);
        $this->assertSame('vending machine', $item->normalized_name);

        $listing = Listing::query()->sole();
        $this->assertSame('8398863', $listing->external_id);
        $this->assertSame($item->id, $listing->item_id);
        $this->assertSame('sell', $listing->side);
        $this->assertSame(10, $listing->price_wl);
        $this->assertSame('The Lost Nemo!', $listing->server);
        $this->assertSame('🔮・buy-sell-crystals', $listing->channel);
        $this->assertSame('MICAX', $listing->world);
        $this->assertFalse($listing->world_verified);
        $this->assertSame('2026-11-08T01:36:37.199Z', $listing->posted_at->utc()->format('Y-m-d\TH:i:s.v\Z'));
    }

    public function test_reuses_the_existing_item_for_new_listings(): void
    {
        $service = app(ListingIngestService::class);

        $service->ingest($this->validPayload(['id' => '1']));
        $service->ingest($this->validPayload(['id' => '2', 'item' => 'Vending machine']));

        $this->assertSame(1, Item::query()->count());
        $this->assertSame(2, Listing::query()->count());

        $itemIds = Listing::query()->pluck('item_id')->unique();
        $this->assertCount(1, $itemIds);
    }

    public function test_normalizes_item_names(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload([
            'item' => "  Vending\t\tMACHINE  ",
        ]));

        $item = Item::query()->sole();
        $this->assertSame('vending machine', $item->normalized_name);
        // The original display name is preserved (trimmed).
        $this->assertSame("Vending\t\tMACHINE", $item->name);

        // Case/spacing variants map to the same master record.
        app(ListingIngestService::class)->ingest($this->validPayload([
            'id' => '999',
            'item' => 'vending   machine',
        ]));

        $this->assertSame(1, Item::query()->count());
        $this->assertSame(2, Listing::query()->count());
    }

    public function test_prevents_duplicate_external_ids_without_overwriting(): void
    {
        $service = app(ListingIngestService::class);

        $service->ingest($this->validPayload());
        $service->ingest($this->validPayload([
            // Same external id, conflicting details: must be ignored entirely.
            'priceWl' => 999,
            'side' => 'buy',
        ]));

        $this->assertSame(1, Listing::query()->count());

        $listing = Listing::query()->sole();
        $this->assertSame('sell', $listing->side);
        $this->assertSame(10, $listing->price_wl);
    }

    public function test_accepts_integer_ids_and_digit_string_prices(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload([
            'id' => 8398863,
            'priceWl' => '10',
        ]));

        $listing = Listing::query()->sole();
        $this->assertSame('8398863', $listing->external_id);
        $this->assertSame(10, $listing->price_wl);
    }

    public function test_preserves_buy_and_sell_sides(): void
    {
        $service = app(ListingIngestService::class);

        $service->ingest($this->validPayload(['id' => '1', 'side' => 'sell']));
        $service->ingest($this->validPayload(['id' => '2', 'side' => 'buy']));

        $this->assertSame(
            ['sell', 'buy'],
            Listing::query()->orderBy('external_id')->pluck('side')->all(),
        );
    }

    public function test_preserves_utc_timestamps_and_milliseconds(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload([
            'postedAt' => '2026-11-08T01:36:37.199Z',
        ]));

        $stored = DB::table('listings')->value('posted_at');

        $this->assertSame('2026-11-08 01:36:37.199', $stored);
    }

    public function test_converts_non_utc_offsets_to_utc(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload([
            'id' => '42',
            'postedAt' => '2026-11-08T08:36:37.500+07:00',
        ]));

        $stored = DB::table('listings')->value('posted_at');

        // 08:36:37.500+07:00 == 01:36:37.500Z
        $this->assertSame('2026-11-08 01:36:37.500', $stored);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function malformedPayloads(): array
    {
        $base = [
            'id' => '8398863',
            'side' => 'sell',
            'item' => 'Vending Machine',
            'priceWl' => 10,
            'postedAt' => '2026-11-08T01:36:37.199Z',
        ];

        return [
            'missing id' => [['id' => null] + $base],
            'empty id' => [['id' => ''] + $base],
            'id too long' => [['id' => str_repeat('x', 65)] + $base],
            'invalid side' => [['side' => 'BUY'] + $base],
            'unknown side' => [['side' => 'hold'] + $base],
            'missing item' => [['item' => null] + $base],
            'empty item' => [['item' => '   '] + $base],
            'item too long' => [['item' => str_repeat('x', 256)] + $base],
            'negative price' => [['priceWl' => -1] + $base],
            'fractional price float' => [['priceWl' => 10.5] + $base],
            'fractional price string' => [['priceWl' => '10.5'] + $base],
            'price with whitespace' => [['priceWl' => '10 '] + $base],
            'missing postedAt' => [['postedAt' => null] + $base],
            'invalid postedAt' => [['postedAt' => 'not-a-date'] + $base],
            'numeric postedAt' => [['postedAt' => 1731027397] + $base],
            'world too long' => [['world' => str_repeat('x', 101)] + $base],
            'server not a string' => [['server' => 123] + $base],
            'worldVerified not boolean' => [['worldVerified' => 'false'] + $base],
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    #[DataProvider('malformedPayloads')]
    public function test_rejects_malformed_payloads(array $payload): void
    {
        app(ListingIngestService::class)->ingest($payload);

        $this->assertSame(0, Item::query()->count());
        $this->assertSame(0, Listing::query()->count());
    }

    public function test_null_optional_fields_are_stored_as_null(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload([
            'server' => null,
            'channel' => null,
            'world' => null,
            'url' => null,
        ]));

        $listing = Listing::query()->sole();

        $this->assertNull($listing->server);
        $this->assertNull($listing->channel);
        $this->assertNull($listing->world);
        $this->assertNull($listing->url);
        $this->assertFalse($listing->world_verified);
    }

    public function test_rejecting_a_payload_does_not_affect_the_next_valid_one(): void
    {
        $service = app(ListingIngestService::class);

        $service->ingest($this->validPayload(['side' => 'invalid']));
        $service->ingest($this->validPayload());

        $this->assertSame(1, Listing::query()->count());
    }
}
