<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Listing;
use App\Services\TopItemsThisWeekService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class TopItemsThisWeekTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    private function freezeNow(string $datetime): Carbon
    {
        $now = Carbon::parse($datetime, 'UTC');

        Carbon::setTestNow($now);

        return $now;
    }

    private function itemWithListings(string $name, int $buyCount, int $sellCount, Carbon $postedAt, int $externalSuffix): Item
    {
        $item = Item::factory()->create([
            'name' => $name,
            'normalized_name' => strtolower($name),
        ]);

        for ($i = 1; $i <= $buyCount; $i++) {
            Listing::factory()->create([
                'external_id' => sprintf('buy-%s-%d-%d', $name, $externalSuffix, $i),
                'item_id' => $item->id,
                'side' => 'buy',
                'posted_at' => $postedAt,
            ]);
        }

        for ($i = 1; $i <= $sellCount; $i++) {
            Listing::factory()->create([
                'external_id' => sprintf('sell-%s-%d-%d', $name, $externalSuffix, $i),
                'item_id' => $item->id,
                'side' => 'sell',
                'posted_at' => $postedAt,
            ]);
        }

        return $item;
    }

    public function test_homepage_returns_ok_and_uses_guest_layout(): void
    {
        $response = $this->get(route('home.index'));

        $response->assertOk();
        $response->assertViewIs('guest.home.index');
        $response->assertSee('Growlytics');
        $response->assertSee('Top Items This Week');
    }

    public function test_homepage_shows_empty_state_without_listings(): void
    {
        $this->freezeNow('2026-11-11 12:00:00');

        $response = $this->get(route('home.index'));

        $response->assertOk();
        $response->assertSee('No listings yet this week');
    }

    public function test_ranks_items_by_total_listings_and_separates_buy_and_sell(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $postedAt = $now->copy()->subDay();

        $first = $this->itemWithListings('Crystal Pack', 3, 2, $postedAt, 1);
        $second = $this->itemWithListings('Vending Machine', 1, 1, $postedAt, 2);

        $response = $this->get(route('home.index'));

        $response->assertOk();
        $response->assertSeeInOrder(['Crystal Pack', 'Vending Machine']);
        $response->assertSee('Total 5');
        $response->assertSee('Buy 3');
        $response->assertSee('Sell 2');
        $response->assertSee('Total 2');
        $response->assertSee('Buy 1');
        $response->assertSee('Sell 1');

        $service = app(TopItemsThisWeekService::class);
        $items = $service->topItemsThisWeek();

        $this->assertSame($first->id, $items->first()['item_id']);
        $this->assertSame(5, $items->first()['total']);
        $this->assertSame(3, $items->first()['buy_count']);
        $this->assertSame(2, $items->first()['sell_count']);
        $this->assertSame(2, $items->last()['total']);
    }

    public function test_previous_week_listings_are_not_counted(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $previousWeek = $now->copy()->subWeek();

        $this->itemWithListings('Old Item', 2, 1, $previousWeek, 1);

        $service = app(TopItemsThisWeekService::class);

        $this->assertCount(0, $service->topItemsThisWeek());
    }

    public function test_listing_exactly_at_monday_midnight_utc_is_counted(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $weekStart = $now->copy()->startOfWeek(Carbon::MONDAY);

        $this->itemWithListings('Midnight Item', 1, 0, $weekStart, 1);

        $service = app(TopItemsThisWeekService::class);
        $items = $service->topItemsThisWeek();

        $this->assertCount(1, $items);
        $this->assertSame('Midnight Item', $items->first()['name']);
    }

    public function test_listing_before_monday_midnight_utc_is_not_counted(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $beforeWeek = $now->copy()->startOfWeek(Carbon::MONDAY)->subSecond();

        $this->itemWithListings('Before Week Item', 1, 0, $beforeWeek, 1);

        $service = app(TopItemsThisWeekService::class);

        $this->assertCount(0, $service->topItemsThisWeek());
    }

    public function test_listing_after_server_now_is_not_counted(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $future = $now->copy()->addMinute();

        $this->itemWithListings('Future Item', 1, 0, $future, 1);

        $service = app(TopItemsThisWeekService::class);

        $this->assertCount(0, $service->topItemsThisWeek());
    }

    public function test_week_transition_from_sunday_to_monday(): void
    {
        $sundayNight = $this->freezeNow('2026-11-15 23:59:00');
        $previousWeekStart = $sundayNight->copy()->subWeek()->startOfWeek(Carbon::MONDAY);

        $this->itemWithListings('Sunday Item', 1, 0, $sundayNight, 1);

        $service = app(TopItemsThisWeekService::class);
        $sundayItems = $service->topItemsThisWeek();

        $this->assertCount(1, $sundayItems);

        Carbon::setTestNow(Carbon::parse('2026-11-16 00:00:00', 'UTC'));

        $mondayItems = $service->topItemsThisWeek();

        $this->assertCount(0, $mondayItems);
        $this->assertSame(
            Carbon::parse('2026-11-16 00:00:00', 'UTC')->toDateTimeString(),
            $service->currentPeriod()['start']->toDateTimeString()
        );
        unset($previousWeekStart);
    }

    public function test_tie_breaker_is_deterministic_by_item_id(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $postedAt = $now->copy()->subDay();

        $first = $this->itemWithListings('Zeta', 1, 0, $postedAt, 1);
        $second = $this->itemWithListings('Alpha', 1, 0, $postedAt, 2);

        $service = app(TopItemsThisWeekService::class);
        $items = $service->topItemsThisWeek();

        $this->assertSame($first->id, $items->first()['item_id']);
        $this->assertSame($second->id, $items->last()['item_id']);
    }

    public function test_returns_maximum_of_ten_items(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $postedAt = $now->copy()->subDay();

        foreach (range(1, 11) as $index) {
            $this->itemWithListings('Item '.$index, 1, 0, $postedAt, $index);
        }

        $service = app(TopItemsThisWeekService::class);

        $this->assertCount(10, $service->topItemsThisWeek());
    }

    public function test_cache_miss_runs_query_and_stores_result(): void
    {
        $this->freezeNow('2026-11-11 12:00:00');

        $service = app(TopItemsThisWeekService::class);
        Cache::forget($service->cacheKey());

        $service->topItemsThisWeek();

        $this->assertTrue(Cache::has($service->cacheKey()));
    }

    public function test_cache_hit_uses_cached_result(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $postedAt = $now->copy()->subDay();

        $this->itemWithListings('Cached Item', 1, 0, $postedAt, 1);

        $service = app(TopItemsThisWeekService::class);
        $first = $service->topItemsThisWeek();

        $this->itemWithListings('New Item', 1, 0, $postedAt, 2);

        $second = $service->topItemsThisWeek();

        $this->assertSame($first->pluck('name')->all(), $second->pluck('name')->all());
        $this->assertCount(1, $second);
    }

    public function test_cache_expires_after_ttl(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $postedAt = $now->copy()->subDay();

        $this->itemWithListings('First Item', 1, 0, $postedAt, 1);

        $service = app(TopItemsThisWeekService::class);
        $service->topItemsThisWeek();

        Carbon::setTestNow($now->copy()->addSeconds(61));

        $this->itemWithListings('Second Item', 1, 0, $postedAt, 2);

        $items = $service->topItemsThisWeek();

        $this->assertCount(2, $items);
    }

    public function test_cache_key_differs_next_utc_week(): void
    {
        $this->freezeNow('2026-11-11 12:00:00');
        $service = app(TopItemsThisWeekService::class);
        $firstKey = $service->cacheKey();

        $this->freezeNow('2026-11-18 12:00:00');
        $secondKey = $service->cacheKey();

        $this->assertNotSame($firstKey, $secondKey);
    }

    public function test_cache_does_not_cross_monday_boundary(): void
    {
        $this->freezeNow('2026-11-15 23:59:50');

        $postedAt = Carbon::parse('2026-11-15 23:59:50', 'UTC');
        $this->itemWithListings('Sunday Item', 1, 0, $postedAt, 1);

        $service = app(TopItemsThisWeekService::class);
        $sundayItems = $service->topItemsThisWeek();

        $this->assertCount(1, $sundayItems);

        Carbon::setTestNow(Carbon::parse('2026-11-16 00:00:00', 'UTC'));

        $mondayItems = $service->topItemsThisWeek();

        $this->assertCount(0, $mondayItems);
    }

    public function test_uses_posted_at_not_created_at(): void
    {
        $now = $this->freezeNow('2026-11-11 12:00:00');
        $outsideWeek = $now->copy()->subWeeks(2);

        $item = Item::factory()->create([
            'name' => 'Timestamp Item',
            'normalized_name' => 'timestamp item',
        ]);

        Listing::factory()->create([
            'external_id' => 'posted-outside',
            'item_id' => $item->id,
            'side' => 'buy',
            'posted_at' => $outsideWeek,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $service = app(TopItemsThisWeekService::class);

        $this->assertCount(0, $service->topItemsThisWeek());
    }
}
