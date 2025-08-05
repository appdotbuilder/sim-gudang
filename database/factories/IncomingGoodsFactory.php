<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomingGoods>
 */
class IncomingGoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-30 days', 'now')->format('Ymd');
        $sequence = fake()->unique()->numberBetween(1, 9999);
        
        return [
            'reference_number' => 'IN-' . $date . '-' . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT),
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 50),
            'supplier' => fake()->company(),
            'notes' => fake()->optional()->sentence(),
            'received_date' => fake()->dateTimeBetween('-30 days', 'now'),
            'user_id' => User::factory(),
        ];
    }
}