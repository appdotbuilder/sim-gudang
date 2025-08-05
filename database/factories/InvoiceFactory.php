<?php

namespace Database\Factories;

use App\Models\OutgoingGoods;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
        $subtotal = fake()->randomFloat(2, 100, 10000);
        $taxAmount = $subtotal * 0.1; // 10% tax
        $totalAmount = $subtotal + $taxAmount;
        
        return [
            'invoice_number' => 'INV-' . $date . '-' . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT),
            'outgoing_goods_id' => OutgoingGoods::factory(),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_address' => fake()->address(),
            'customer_phone' => fake()->phoneNumber(),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => fake()->randomElement(['draft', 'sent', 'paid', 'overdue']),
            'invoice_date' => fake()->dateTimeBetween('-30 days', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}