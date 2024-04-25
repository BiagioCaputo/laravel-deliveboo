<?php

namespace Database\Factories;


use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => fake()->numberBetween(1, 4),
            'customer_name' => fake()->firstName(),
            'customer_address' => fake()->address(),
            'customer_email' => fake()->email(),
            'customer_phone' => fake()->phoneNumber(),
            'total_price' => fake()->randomFloat(3, 0, 999),
            'status' => fake()->boolean(),
        ];
    }
}
