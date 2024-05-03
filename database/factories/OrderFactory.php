<?php

namespace Database\Factories;

use App\Models\Dish;
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

        $restaurantId = $this->faker->numberBetween(1, 12);

        // Otteniamo i piatti disponibili per questo ristorante
        $dishes = Dish::where('restaurant_id', $restaurantId)->pluck('id')->toArray();


        return [
            'restaurant_id' => $restaurantId,
            'customer_name' => fake()->firstName(),
            'customer_address' => fake()->address(),
            'customer_email' => fake()->email(),
            'customer_phone' => fake()->phoneNumber(),
            'total_price' => fake()->randomFloat(3, 0, 999),
            'status' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-5 year', 'now')->format('Y-m-d H:i:s'), // created_at randomico con data fra adesso e 5 anni fa


        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            // Otteniamo i piatti disponibili per il ristorante associato all'ordine
            $dishes = Dish::where('restaurant_id', $order->restaurant_id)->pluck('id')->toArray();

            // Selezioniamo casualmente alcuni piatti
            $selectedDishes = $this->faker->randomElements($dishes, $this->faker->numberBetween(1, count($dishes)));

            // Associa i piatti all'ordine tramite la tabella pivot
            $order->dishes()->attach($selectedDishes);
        });
    }
}
