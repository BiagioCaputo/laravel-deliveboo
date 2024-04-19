<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        Storage::makeDirectory('dish_images');
        $name = fake()->word();
        $slug = Str::slug($name);
        $img = fake()->imageUrl(250, 250);
        $img_url = Storage::putFileAs('dish_images', $img, "$slug.png");

        return [
            //
            // 'course_id' => fake()->numberBetween(0, 9),
            'name' => $name,
            'image' => $img_url,
            'ingredients' => fake()->sentence(10),
            'price' => fake()->randomFloat(3, 0, 99),
            'description' => fake()->sentence(10),
            'available' => fake()->boolean(),
        ];
    }
}
