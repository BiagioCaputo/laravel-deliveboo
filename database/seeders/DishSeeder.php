<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = [
            [
                "name" => "Pizza Margherita",
                "price" => 4.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Mozzarella, pomodoro, basilico",
                "description" => "Classica pizza margherita realizzata con i migliori ingredienti KM 0",
                "available" => true,
            ],

            [
                "name" => "Pizza Caprese",
                "price" => 7.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Mozzarella di Bufala, pachino, olive, basilico e parmiggiano reggiano",
                "description" => "Focaccia con tutti gli ingredienti sopra elencati posti a crudo",
                "available" => true,
            ],

            [
                "name" => "Calzone Classico",
                "price" => 5.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Prociutto cotto, pomodoro, salame piccante, scamorza, parmigiano, ricotta di pecora",
                "description" => "Doverosi parmiggiano, basilico e olio a crudo",
                "available" => true,
            ],

            [
                "name" => "Bistecca di manzo",
                "price" => 15.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 3,
                "ingredients" => "Carne di manzo, olio, sale",
                "description" => "Succolenta bistecca di manzo impacchettata con una porzione di patatine fritte",
                "available" => true,
            ],

            [
                "name" => "Patatine fritte",
                "price" => 3.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 4,
                "ingredients" => "Patate, olio di semi di Girasole, sale",
                "description" => "",
                "available" => true,
            ],

            [
                "name" => "Tiramisù",
                "price" => 4.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 5,
                "ingredients" => "Uova, caffè, mascarpone, zucchero, cacao",
                "description" => "Il tricolore nel cacao",
                "available" => true,
            ],

            [
                "name" => "Sprite",
                "price" => 2.50,
                "image" => "",
                "restaurant_id" => 1,
                "course_id" => 6,
                "ingredients" => "",
                "description" => "",
                "available" => true,
            ],



        ];

        foreach ($dishes as $dish) {
            $new_dish = new Dish();

            // Assegno massivamente i valori alla nuova istanza di dish
            $new_dish->fill($dish);

            // Salvo le modifiche
            $new_dish->save();
        }
    }
}
