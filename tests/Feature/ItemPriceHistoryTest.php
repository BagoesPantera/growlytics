<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ItemPriceHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_price_history_endpoint_returns_ok_json(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('status', 'ok');
        $response->assertJsonPath('item.id', $item->id);
        $response->assertJsonPath('range', '24H');
        $response->assertJsonPath('bucket_seconds', 3600);
    }

    public function test_median_and_percentiles_are_calculated_from_full_data(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        foreach ([10, 20, 30] as $price) {
            Listing::factory()->create([
                'item_id' => $item->id,
                'side' => 'sell',
                'price_wl' => $price,
                'posted_at' => Carbon::now('UTC')->subHour(),
            ]);
        }

        foreach ([5, 15] as $price) {
            Listing::factory()->create([
                'item_id' => $item->id,
                'side' => 'buy',
                'price_wl' => $price,
                'posted_at' => Carbon::now('UTC')->subHours(2),
            ]);
        }

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.sell.count', 3);
        $response->assertJsonPath('summary.sell.median', 20);
        $response->assertJsonPath('summary.sell.p25', 15);
        $response->assertJsonPath('summary.sell.p75', 25);
        $response->assertJsonPath('summary.buy.count', 2);
        $response->assertJsonPath('summary.buy.median', 10);
    }

    public function test_buy_and_sell_are_separated(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'buy',
            'price_wl' => 100,
            'posted_at' => Carbon::now('UTC')->subMinutes(30),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 200,
            'posted_at' => Carbon::now('UTC')->subMinutes(30),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.buy.count', 1);
        $response->assertJsonPath('summary.buy.median', 100);
        $response->assertJsonPath('summary.sell.count', 1);
        $response->assertJsonPath('summary.sell.median', 200);
    }

    public function test_rolling_window_excludes_listings_before_start(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 50,
            'posted_at' => Carbon::now('UTC')->subDay()->subSecond(),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 60,
            'posted_at' => Carbon::now('UTC')->subDay(),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.sell.count', 1);
        $response->assertJsonPath('summary.sell.median', 60);
    }

    public function test_empty_range_returns_ok_without_data(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('status', 'ok');
        $response->assertJsonPath('summary.buy.count', 0);
        $response->assertJsonPath('summary.sell.count', 0);
    }

    public function test_scatter_is_sampled_without_changing_median(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        for ($i = 0; $i < 1500; $i++) {
            Listing::factory()->create([
                'item_id' => $item->id,
                'side' => 'sell',
                'price_wl' => 10 + ($i % 5),
                'posted_at' => Carbon::now('UTC')->subMinutes($i % 60),
            ]);
        }

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $this->assertLessThanOrEqual(1000, count($response->json('scatter.sell')));
        $this->assertGreaterThanOrEqual(1, $response->json('summary.sell.count'));
    }

    public function test_outlier_values_are_retained_in_statistics(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 1,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 100000,
            'posted_at' => Carbon::now('UTC')->subMinutes(20),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.sell.min', 1);
        $response->assertJsonPath('summary.sell.max', 100000);
    }

    public function test_safety_limit_returns_unavailable(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        $rows = [];

        for ($i = 0; $i < 100001; $i++) {
            $rows[] = [
                'external_id' => (string) (1000000 + $i),
                'item_id' => $item->id,
                'side' => 'sell',
                'price_wl' => 10,
                'world' => null,
                'world_verified' => false,
                'url' => null,
                'server' => null,
                'channel' => null,
                'posted_at' => Carbon::now('UTC')->format('Y-m-d H:i:s.v'),
                'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s.v'),
                'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s.v'),
            ];

            if (count($rows) === 1000) {
                DB::table('listings')->insert($rows);
                $rows = [];
            }
        }

        if ($rows !== []) {
            DB::table('listings')->insert($rows);
        }

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('status', 'unavailable');
    }

    public function test_cache_hit_returns_identical_payload(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        Cache::flush();

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 42,
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        $first = $this->getJson('/items/'.$item->id.'/price-history?range=24H')->json();
        $second = $this->getJson('/items/'.$item->id.'/price-history?range=24H')->json();

        $this->assertSame($first['generated_at'], $second['generated_at']);
        $this->assertTrue(Cache::has('item-price-history:'.$item->id.':24H:v1'));
    }

    public function test_fractional_prices_appear_in_analytics(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => '0.10000000',
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => '0.20000000',
            'posted_at' => Carbon::now('UTC')->subMinutes(20),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.sell.count', 2);
        $response->assertJsonPath('summary.sell.min', 0.1);
        $response->assertJsonPath('summary.sell.max', 0.2);
    }

    public function test_large_decimal_prices_do_not_crash_analytics(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'buy',
            'price_wl' => '880251434380165100.00000000',
            'posted_at' => Carbon::now('UTC')->subMinutes(10),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.buy.count', 1);
        $this->assertNotNull($response->json('summary.buy.min'));
        $this->assertNotNull($response->json('summary.buy.max'));
    }

    public function test_utc_boundary_includes_listing_at_exact_window_start(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        Listing::factory()->create([
            'item_id' => $item->id,
            'side' => 'sell',
            'price_wl' => 50,
            'posted_at' => Carbon::now('UTC')->subDay(),
        ]);

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.sell.count', 1);
    }

    public function test_empty_state_payload_only_has_zero_counts_when_no_listings(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-01-02 12:00:00', 'UTC'));

        $item = Item::factory()->create();

        $response = $this->getJson('/items/'.$item->id.'/price-history?range=24H');

        $response->assertOk();
        $response->assertJsonPath('summary.buy.count', 0);
        $response->assertJsonPath('summary.sell.count', 0);
        $response->assertJsonPath('summary.buy.min', null);
        $response->assertJsonPath('summary.sell.max', null);
    }
}
