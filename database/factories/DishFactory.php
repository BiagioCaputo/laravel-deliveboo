<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->word(),
            'image' => fake()->image(null, 640, 480),
            'ingredients' => fake()->sentence(10),
            'price' => fake()->randomFloat(3, 0, 99),
            'description' => fake()->sentence(10),
            'available' => fake()->boolean(),
        ];
    }
}
