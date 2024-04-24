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
                'description' => 'Preparate secondo la migliore tradizione, per godersi una bella serata tra amici, concludere la giornata di vacanza, prepararsi ad una notte di festa e divertimento. Dalle più classiche alle più saporite, dalle più semplici alle più ricche e sfiziose, come la Bismarck, la Patapizza, la Golosa e la stagionata. Dalla Pizza quattro stagioni alla Pizza per ogni stagione, ognuna con un assortimento particolare di ingredienti per dare un tocco unico.',
                'image' => '',
                'logo' => '',
                'phone' => '+39 0321 032310',
                'user_id' => 1,
            ],
            [
                'activity_name' => 'Fratelli Labufala',
                'address' => 'Via Torino, 27',
                'vat' => '00000000011',
                'description' => 'Trattoria italiana',
                'image' => '',
                'logo' => '',
                'phone' => '+39 0321 032310',
                'user_id' => 2,
            ],
            [
                'activity_name' => 'Old Wild West',
                'address' => 'Via Milano, 30',
                'vat' => '00000000012',
                'description' => 'Famosa catena fast food',
                'image' => '',
                'logo' => '',
                'user_id' => 3,
            ],
            [
                'activity_name' => 'I Love poke',
                'address' => 'Via Milano, 30',
                'vat' => '00000000013',
                'description' => 'Poke o poke',
                'image' => '',
                'logo' => '',
                'phone' => '+39 0321 032310',
                'user_id' => 4,
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
