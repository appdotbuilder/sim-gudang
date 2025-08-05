<?php

namespace Database\Factories;

use App\Models\OutgoingGoods;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryOrder>
 */
class DeliveryOrderFactory extends Factory
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
            'order_number' => 'DO-' . $date . '-' . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT),
            'outgoing_goods_id' => OutgoingGoods::factory(),
            'customer_name' => fake()->name(),
            'customer_address' => fake()->address(),
            'customer_phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['pending', 'in_transit', 'delivered']),
            'delivery_date' => fake()->dateTimeBetween('now', '+7 days'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}