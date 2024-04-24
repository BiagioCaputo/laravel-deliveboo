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
            ["label" => "Italiana", "image" => ""],
            ["label" => "Francese", "image" => ""],
            ["label" => "Giapponese", "image" => ""],
            ["label" => "Messicana", "image" => ""],
            ["label" => "Cinese", "image" => ""],
            ["label" => "Poke", "image" => ""],
            ["label" => "Indiano", "image" => ""],
            ["label" => "Pizza", "image" => ""],
            ["label" => "Hamburger", "image" => ""],
            ["label" => "Sushi", "image" => ""],
            ["label" => "Carne", "image" => ""],
            ["label" => "Pesce", "image" => ""],
            ["label" => "Vegano", "image" => ""],
            ["label" => "Vegetariano", "image" => ""],
            ["label" => "Fritti", "image" => ""]
        ];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->label = $type['label'];
            $newType->image = $type['image'];
            $newType->save();
        }
    }
}
