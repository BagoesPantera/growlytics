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
}
