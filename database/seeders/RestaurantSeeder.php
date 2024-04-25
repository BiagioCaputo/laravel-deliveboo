<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera tutte le tipologie di ristoranti
        $types = Type::all();

        $restaurants = [
            [
                'activity_name' => 'Pizzeria Sorbillo',
                'address' => 'Via Roma, 50',
                'vat' => '00000000010',
                'description' => 'Preparate secondo la migliore tradizione, per godersi una bella serata tra amici, concludere la giornata di vacanza, prepararsi ad una notte di festa e divertimento. Dalle più classiche alle più saporite, dalle più semplici alle più ricche e sfiziose, come la Bismarck, la Patapizza, la Golosa e la stagionata. Dalla Pizza quattro stagioni alla Pizza per ogni stagione, ognuna con un assortimento particolare di ingredienti per dare un tocco unico.',
                'image' => 'pizzeria-sobrillo.jpg',
                'logo' => 'pizzeria-sobrillo-lg.jpg',
                'phone' => '+39 351 7890931',
                'user_id' => 1,
                'types' => [1, 8],
            ],
            [
                'activity_name' => 'Fratelli Labufala',
                'address' => 'Via Torino, 27',
                'vat' => '00000000011',
                'description' => 'Un\'autentica esperienza culinaria italiana con piatti tradizionali come pasta fatta in casa, pizza al forno a legna e deliziosi antipasti.',
                'image' => 'labufala.webp',
                'logo' => 'labufala-lg.avif',
                'phone' => '+39 351 7790641',
                'user_id' => 2,
                'types' => [1, 11],
            ],
            [
                'activity_name' => 'Old Wild West',
                'address' => 'Via Milano, 30',
                'vat' => '00000000012',
                'description' => 'Vieni a gustare i sapori del selvaggio west con i nostri hamburger succulenti, patatine croccanti e altri classici della cucina americana.',
                'image' => 'old.jpg',
                'logo' => 'old-lg.png',
                'phone' => '+39 351 7890831',
                'user_id' => 3,
                'types' => [16],
            ],
            [
                'activity_name' => 'I Love poke',
                'address' => 'Via Milano, 30',
                'vat' => '00000000013',
                'description' => 'Esplora il gusto fresco e vibrante delle isole con i nostri deliziosi piatti di poke. Preparato con ingredienti freschi e saporiti per un\'esperienza culinaria unica.',
                'image' => 'poke.jpg',
                'logo' => 'poke-lg.avif',
                'phone' => '+39 351 7844431',
                'user_id' => 4,
                'types' => [6],
            ],
            [
                'activity_name' => 'McDonald',
                'address' => 'Via Settembre, 20',
                'vat' => '00000000453',
                'description' => 'Il celebre fast food McDonald\'s ti offre un\'ampia selezione di hamburger, patatine fritte, bevande e dessert. Gusta il classico sapore McDonald\'s oggi!',
                'image' => 'mc.jpg',
                'logo' => 'mc-lg.webp',
                'phone' => '+39 351 7890333',
                'user_id' => 5,
                'types' => [16],
            ],
            [
                'activity_name' => 'La Scogliera',
                'address' => 'Via Lampuga, 10',
                'vat' => '00000000022',
                'description' => 'Immergiti nei sapori del mare con i nostri piatti freschi e deliziosi di pesce. Dai antipasti alle zuppe e ai piatti principali, ogni boccone è un viaggio culinario sulla costa.',
                'image' => 'scogliera.jpg',
                'logo' => 'scogliera-lg.avif',
                'phone' => '+39 380 7890931',
                'user_id' => 6,
                'types' => [1, 12],
            ],
            [
                'activity_name' => 'La muraglia',
                'address' => 'Via Tito, 40',
                'vat' => '00000000023',
                'description' => 'Esplora la ricca e variegata cucina cinese con i nostri piatti tradizionali e autentici. Dalla zuppa agrodolce al pollo alla Kung Pao, ogni piatto è una festa per il palato.',
                'image' => 'muraglia.jpg',
                'logo' => 'muraglia-lg.png',
                'phone' => '+39 380 7844931',
                'user_id' => 7,
                'types' => [5],
            ],
            [
                'activity_name' => 'Sushiko',
                'address' => 'Via Saturno, 39',
                'vat' => '00000000029',
                'description' => 'Delizia i tuoi sensi con la nostra autentica cucina giapponese. Dai sushi alle tempura, ogni piatto è preparato con maestria per garantire una vera esperienza culinaria giapponese.',
                'image' => 'sushiko.jpg',
                'logo' => 'sushiko-lg.png',
                'phone' => '+39 351 7999931',
                'user_id' => 8,
                'types' => [3],
            ],

        ];

        foreach ($restaurants as $restaurant) {

            $newRestaurant = new Restaurant();

            // Compila i dati del ristorante
            $newRestaurant->activity_name = $restaurant['activity_name'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->vat = $restaurant['vat'];
            $newRestaurant->description = $restaurant['description'];
            $newRestaurant->image = $restaurant['image'];
            $newRestaurant->logo = $restaurant['logo'];
            $newRestaurant->phone = $restaurant['phone'];
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->save();

            // Associa le tipologie al ristorante
            $newRestaurant->types()->attach($restaurant['types']);

            // Se c'è un'immagine, sposta l'immagine nella directory di storage e aggiorna il percorso nel database
            if (!empty($restaurant['image'])) {
                $imageName = $restaurant['image'];
                $imagePath = public_path('img/restaurant_img/' . $imageName);
                $newImagePath = 'restaurant_images/' . $imageName;
                Storage::put($newImagePath, file_get_contents($imagePath));
                $newRestaurant->image = $newImagePath;
                $newRestaurant->save();
            }

            // Se c'è un logo, sposta il logo nella directory di storage e aggiorna il percorso nel database
            if (!empty($restaurant['logo'])) {
                $logoName = $restaurant['logo'];
                $logoPath = public_path('img/restaurant_img/' . $logoName);
                $newLogoPath = 'restaurant_logos/' . $logoName;
                Storage::put($newLogoPath, file_get_contents($logoPath));
                $newRestaurant->logo = $newLogoPath;
                $newRestaurant->save();
            }
        }
    }
}
