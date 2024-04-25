<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //da aggiungere le immagini!
        $types = [
            ["label" => "Italiana", "image" => ""], //1
            ["label" => "Francese", "image" => ""], //2
            ["label" => "Giapponese", "image" => ""], //3
            ["label" => "Messicana", "image" => ""], //4
            ["label" => "Cinese", "image" => ""], //5
            ["label" => "Poke", "image" => ""], //6
            ["label" => "Indiano", "image" => ""], //7
            ["label" => "Pizza", "image" => ""], //8
            ["label" => "Hamburger", "image" => ""], //9
            ["label" => "Sushi", "image" => ""], //10
            ["label" => "Carne", "image" => ""], //11
            ["label" => "Pesce", "image" => ""], //12
            ["label" => "Vegano", "image" => ""], //13
            ["label" => "Vegetariano", "image" => ""], //14
            ["label" => "Fritti", "image" => ""], //15
            ["label" => "Fast Food", "image" => ""] //16
        ];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->label = $type['label'];
            $newType->image = $type['image'];
            $newType->save();
        }
    }
}
