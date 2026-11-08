<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'external_id' => (string) $this->faker->unique()->numberBetween(1_000_000, 9_999_999),
            'item_id' => Item::factory(),
            'side' => $this->faker->randomElement(['buy', 'sell']),
            'price_wl' => $this->faker->numberBetween(1, 10_000),
            'server' => $this->faker->optional()->randomElement(['The Lost Nemo!', 'Growtopia']),
            'channel' => $this->faker->optional()->randomElement(['🔮・buy-sell-crystals', 'market']),
            'world' => $this->faker->optional()->bothify('??????'),
            'world_verified' => $this->faker->boolean(),
            'url' => $this->faker->optional()->url(),
            'posted_at' => $this->faker->dateTimeBetween('-7 days'),
        ];
    }
}
