<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Services\ItemSlugGenerator;
use App\Services\ListingIngestService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemSlugTest extends TestCase
{
    use RefreshDatabase;

    public function test_generated_slug_has_five_alphanumeric_suffix(): void
    {
        $slug = ItemSlugGenerator::generate('Wolf Whistle');

        $this->assertMatchesRegularExpression('/^wolf-whistle-[A-Za-z0-9]{5}$/', $slug);
    }

    public function test_suffix_is_always_present(): void
    {
        $slug = ItemSlugGenerator::generate('Diamond Lock');

        $this->assertMatchesRegularExpression('/-[A-Za-z0-9]{5}$/', $slug);
    }

    public function test_empty_prefix_falls_back_to_item(): void
    {
        $this->assertSame('item', ItemSlugGenerator::prefixFor('!!!'));
    }

    public function test_long_prefix_is_truncated_to_maximum_slug_length(): void
    {
        $prefix = ItemSlugGenerator::prefixFor(str_repeat('a', 300));

        $this->assertLessThanOrEqual(249, strlen($prefix));
    }

    public function test_unicode_or_symbol_name_uses_fallback_prefix(): void
    {
        $slug = ItemSlugGenerator::generate('☆☆☆');

        $this->assertStringStartsWith('item-', $slug);
    }

    public function test_ingestion_creates_slug_for_new_item(): void
    {
        app(ListingIngestService::class)->ingest($this->validPayload());

        $item = Item::query()->sole();

        $this->assertNotNull($item->slug);
        $this->assertMatchesRegularExpression('/^vending-machine-[A-Za-z0-9]{5}$/', $item->slug);
    }

    public function test_ingestion_reuses_existing_item_without_changing_slug(): void
    {
        $item = Item::factory()->create([
            'name' => 'Vending Machine',
            'normalized_name' => 'vending machine',
            'slug' => 'vending-machine-existing',
        ]);

        app(ListingIngestService::class)->ingest($this->validPayload());

        $item->refresh();

        $this->assertSame('vending-machine-existing', $item->slug);
        $this->assertSame(1, Item::query()->count());
    }

    public function test_slug_route_returns_ok(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc12',
        ]);

        $response = $this->get(route('items.show', $item->slug));

        $response->assertOk();
        $response->assertSee('Crystal Pack');
    }

    public function test_unknown_slug_returns_404(): void
    {
        $this->get('/items/does-not-exist-slug')->assertNotFound();
    }

    public function test_legacy_numeric_url_redirects_with_301(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc12',
        ]);

        $response = $this->get('/items/'.$item->id);

        $response->assertStatus(301);
        $response->assertRedirect(route('items.show', $item->slug));
    }

    public function test_price_history_works_from_slug_url(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc12',
        ]);

        $response = $this->getJson('/items/'.$item->slug.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('item.id', $item->id);
    }

    public function test_search_returns_slug_url(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc12',
        ]);

        $response = $this->getJson('/search/items?q=crystal');

        $response->assertOk();
        $response->assertJsonPath('data.0.url', route('items.show', $item->slug));
    }

    public function test_backfill_is_idempotent_and_resumable(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => null,
        ]);

        $this->artisan('growlytics:backfill-item-slugs')->assertExitCode(0);

        $item->refresh();
        $this->assertNotNull($item->slug);
        $originalSlug = $item->slug;

        $this->artisan('growlytics:backfill-item-slugs')->assertExitCode(0);

        $item->refresh();
        $this->assertSame($originalSlug, $item->slug);
    }

    public function test_backfill_dry_run_does_not_write_slug(): void
    {
        Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => null,
        ]);

        $this->artisan('growlytics:backfill-item-slugs', ['--dry-run' => true])->assertExitCode(0);

        $this->assertNull(Item::query()->sole()->slug);
    }

    protected function validPayload(array $overrides = []): array
    {
        return array_merge([
            'id' => '8398863',
            'side' => 'sell',
            'item' => 'Vending Machine',
            'priceWl' => 10,
            'server' => 'The Lost Nemo!',
            'channel' => 'test',
            'world' => 'MICAX',
            'worldVerified' => false,
            'url' => 'https://example.com',
            'postedAt' => '2026-11-08T01:36:37.199Z',
        ], $overrides);
    }
}
