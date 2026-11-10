<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_detail_returns_ok_and_uses_guest_layout(): void
    {
        $item = Item::factory()->create(['name' => 'Crystal Pack', 'normalized_name' => 'crystal pack']);

        $response = $this->get(route('items.show', $item));

        $response->assertOk();
        $response->assertViewIs('guest.items.show');
        $response->assertSee('Crystal Pack');
    }

    public function test_missing_item_returns_404(): void
    {
        $response = $this->get('/items/999999');

        $response->assertNotFound();
    }

    public function test_detail_resolves_item_by_slug(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc123',
        ]);

        $response = $this->get('/items/crystal-pack-abc123');

        $response->assertOk();
        $response->assertSee('Crystal Pack');
    }

    public function test_detail_redirects_numeric_id_to_slug(): void
    {
        $item = Item::factory()->create([
            'name' => 'Crystal Pack',
            'normalized_name' => 'crystal pack',
            'slug' => 'crystal-pack-abc123',
        ]);

        $response = $this->get('/items/'.$item->id);

        $response->assertRedirect(route('items.show', $item));
    }
}
