<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ItemRecentWorldsTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_recent_worlds_returns_only_sell_listings_with_world(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'buy',
            'world' => 'BUYWORLD',
            'price_wl' => 10,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => null,
            'price_wl' => 20,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'SELLWORLD',
            'price_wl' => 30,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/recent-worlds');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $response->assertJsonPath('data.0.world', 'SELLWORLD');
        $response->assertJsonPath('data.0.price_wl', 30);
    }

    public function test_recent_worlds_uses_rolling_24_hour_window(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'OLDWORLD',
            'price_wl' => 10,
            'posted_at' => Carbon::now('UTC')->subDay()->subSecond(),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'NEWWORLD',
            'price_wl' => 20,
            'posted_at' => Carbon::now('UTC')->subHour(),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/recent-worlds');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $response->assertJsonPath('data.0.world', 'NEWWORLD');
    }

    public function test_recent_worlds_orders_by_posted_at_and_id_descending(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        $older = Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'OLDER',
            'price_wl' => 10,
            'posted_at' => Carbon::now('UTC')->subHours(2),
        ]);

        $newer = Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'NEWER',
            'price_wl' => 20,
            'posted_at' => Carbon::now('UTC')->subHour(),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/recent-worlds');

        $response->assertOk();
        $response->assertJsonPath('data.0.world', 'NEWER');
        $response->assertJsonPath('data.1.world', 'OLDER');
    }

    public function test_recent_worlds_paginates_twenty_items(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        foreach (range(1, 25) as $index) {
            Listing::factory()->create([
                'item_id' => $item->id,
                'side' => 'sell',
                'world' => 'WORLD'.$index,
                'price_wl' => $index,
                'posted_at' => Carbon::now('UTC')->subMinutes($index),
            ]);
        }

        $first = $this->getJson('/items/'.$item->id.'/recent-worlds?page=1');
        $second = $this->getJson('/items/'.$item->id.'/recent-worlds?page=2');

        $first->assertOk();
        $second->assertOk();
        $this->assertCount(20, $first->json('data'));
        $this->assertCount(5, $second->json('data'));
        $this->assertTrue($first->json('has_more'));
        $this->assertFalse($second->json('has_more'));
    }

    public function test_recent_worlds_returns_null_for_invalid_url(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'WORLD',
            'url' => 'javascript:alert(1)',
            'price_wl' => 10,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/recent-worlds');

        $response->assertOk();
        $response->assertJsonPath('data.0.url', null);
    }

    public function test_recent_worlds_cache_hit_returns_identical_payload(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        Cache::flush();

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'world' => 'WORLD',
            'price_wl' => 10,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        $first = $this->getJson('/items/'.$item->id.'/recent-worlds')->json();
        $second = $this->getJson('/items/'.$item->id.'/recent-worlds')->json();

        $this->assertSame($first['period']['start'], $second['period']['start']);
        $this->assertTrue(Cache::has('item-recent-worlds:'.$item->id.':page:1:v1'));
    }
}
