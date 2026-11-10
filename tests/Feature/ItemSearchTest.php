<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_requires_minimum_two_characters(): void
    {
        Item::factory()->create(['name' => 'Crystal Pack', 'normalized_name' => 'crystal pack']);

        $response = $this->getJson('/search/items?q=c');

        $response->assertOk();
        $response->assertJson(['data' => []]);
    }

    public function test_search_returns_maximum_eight_results(): void
    {
        foreach (range(1, 10) as $index) {
            Item::factory()->create([
                'name' => 'Item '.$index,
                'normalized_name' => 'item '.$index,
            ]);
        }

        $response = $this->getJson('/search/items?q=item');

        $response->assertOk();
        $this->assertCount(8, $response->json('data'));
    }

    public function test_search_prioritizes_prefix_matches(): void
    {
        Item::factory()->create(['name' => 'Crystal Pack', 'normalized_name' => 'crystal pack']);
        Item::factory()->create(['name' => 'Mega Crystal', 'normalized_name' => 'mega crystal']);

        $response = $this->getJson('/search/items?q=crystal');

        $response->assertOk();
        $this->assertSame('Crystal Pack', $response->json('data.0.name'));
    }

    public function test_search_normalizes_query(): void
    {
        Item::factory()->create(['name' => 'Crystal Pack', 'normalized_name' => 'crystal pack']);

        $response = $this->getJson('/search/items?q='.urlencode('  CRYSTAL   PACK  '));

        $response->assertOk();
        $this->assertSame('Crystal Pack', $response->json('data.0.name'));
    }

    public function test_search_returns_json_with_url(): void
    {
        $item = Item::factory()->create(['name' => 'Crystal Pack', 'normalized_name' => 'crystal pack']);

        $response = $this->getJson('/search/items?q=crystal');

        $response->assertOk();
        $response->assertJsonPath('data.0.id', $item->id);
        $response->assertJsonPath('data.0.url', route('items.show', $item));
    }
}
