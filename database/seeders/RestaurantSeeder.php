<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            [
                'activity_name' => 'Pizzeria Sorbillo',
                'address' => 'Via Roma, 50',
                'vat' => '00000000010',
                'email' => 'sorbillo@clienti.it',
                'description' => 'Pizzeria italiana',
                'image' => 'non saprei',
                'user_id' => 1
            ],
            [
                'activity_name' => 'Fratelli Labufala',
                'address' => 'Via Torino, 27',
                'vat' => '00000000011',
                'email' => 'fratellilabufala@clienti.it',
                'description' => 'Trattoria italiana',
                'image' => 'non saprei',
                'user_id' => 2
            ],
            [
                'activity_name' => 'Old Wild West',
                'address' => 'Via Milano, 30',
                'vat' => '00000000012',
                'email' => 'oldwildwest@clienti.it',
                'description' => 'Famosa catena fast food',
                'image' => 'non saprei',
                'user_id' => 3
            ],
            [
                'activity_name' => 'I Love poke',
                'address' => 'Via Milano, 30',
                'vat' => '00000000013',
                'email' => 'ilovepoke@clienti.it',
                'description' => 'Poke o poke',
                'image' => 'non saprei',
                'user_id' => 4
            ],

        ];

        foreach ($restaurants as $restaurant) {
            $new_restaurant = new Restaurant();

            // Assegno a mano i valori alla nuova istanza di restaurant
            // $new_restaurant->activity_name = $restaurant['activity_name'];
            // $new_restaurant->address = $restaurant['address'];
            // $new_restaurant->vat = $restaurant['vat'];
            // $new_restaurant->email = $restaurant['email'];
            // $new_restaurant->image = $restaurant['image'];

            // Assegno massivamente i valori alla nuova istanza di restaurant
            $new_restaurant->fill($restaurant);

            $new_restaurant->slug = Str::slug($restaurant['activity_name']);

            // Salvo le modifiche
            $new_restaurant->save();
        }
    }
}
