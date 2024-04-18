<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'image' => 'non saprei',
            ],
            [
                'activity_name' => 'Fratelli Labufala',
                'address' => 'Via Torino, 27',
                'vat' => '00000000011',
                'email' => 'fratellilabufala@clienti.it',
                'image' => 'non saprei',
            ],
            [
                'activity_name' => 'Old Wild West',
                'address' => 'Via Milano, 30',
                'vat' => '00000000012',
                'email' => 'oldwildwest@clienti.it',
                'image' => 'non saprei',
            ],
            [
                'activity_name' => 'I Love poke',
                'address' => 'Via Milano, 30',
                'vat' => '00000000013',
                'email' => 'ilovepoke@clienti.it',
                'image' => 'non saprei',
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

            // Salvo le modifiche
            $new_restaurant->save();
        }
    }
}
