<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //da aggiungere le immagini!
        $types = [
            ["label" => "Italiana", "image" => "italian.png"], //1
            ["label" => "Francese", "image" => "breakfast.png"], //2
            ["label" => "Giapponese", "image" => "japanese.png"], //3
            ["label" => "Messicana", "image" => "messicano.png"], //4
            ["label" => "Cinese", "image" => "asian.png"], //5
            ["label" => "Poke", "image" => "poke.png"], //6
            ["label" => "Indiano", "image" => "indian.png"], //7
            ["label" => "Pizza", "image" => "pizza.png"], //8
            ["label" => "Hamburger", "image" => "burger.png"], //9
            ["label" => "Sushi", "image" => "sushi.png"], //10
            ["label" => "Carne", "image" => "meat.png"], //11
            ["label" => "Pesce", "image" => "fish.png"], //12
            ["label" => "Vegano", "image" => "veg.png"], //13
            ["label" => "Vegetariano", "image" => "veg.png"], //14
            ["label" => "Fritti", "image" => "fries.png"], //15
            ["label" => "Fast Food", "image" => "fries.png"] //16
        ];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->label = $type['label'];
            $newType->image = $type['image'];
            $newType->save();

            // Se c'è un'immagine, sposta l'immagine nella directory di storage e aggiorna il percorso nel database
            if (!empty($type['image'])) {
                $imageName = $type['image'];
                $imagePath = public_path('img/type_images/' . $imageName);
                $newImagePath = 'type_images/' . $imageName;
                Storage::put($newImagePath, file_get_contents($imagePath));
                $newType->image = $newImagePath;
                $newType->save();
            }
        }
    }
}
