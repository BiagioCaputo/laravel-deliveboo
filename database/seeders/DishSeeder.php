<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = [

            //Pizzeria Sobrillo
            [
                "name" => "Pizza Margherita",
                "price" => 4.50,
                "image" => "margherita.jpg",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Mozzarella, pomodoro, basilico",
                "description" => "Classica pizza margherita realizzata con i migliori ingredienti KM 0",
                "available" => true,
            ],

            [
                "name" => "Pizza Caprese",
                "price" => 7.50,
                "image" => "caprese.jpg",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Mozzarella di Bufala, pachino, olive, basilico e parmiggiano reggiano",
                "description" => "Focaccia con tutti gli ingredienti sopra elencati posti a crudo",
                "available" => true,
            ],

            [
                "name" => "Calzone Classico",
                "price" => 5.50,
                "image" => "calzone.jpg",
                "restaurant_id" => 1,
                "course_id" => 2,
                "ingredients" => "Prociutto cotto, pomodoro, salame piccante, scamorza, parmigiano, ricotta di pecora",
                "description" => "Doverosi parmiggiano, basilico e olio a crudo",
                "available" => true,
            ],

            [
                "name" => "Bistecca di manzo",
                "price" => 15.50,
                "image" => "bistecca.jpg",
                "restaurant_id" => 1,
                "course_id" => 3,
                "ingredients" => "Carne di manzo, olio, sale",
                "description" => "Succolenta bistecca di manzo impacchettata con una porzione di patatine fritte",
                "available" => true,
            ],

            [
                "name" => "Patatine fritte",
                "price" => 3.50,
                "image" => "patatine-fritte.jpg",
                "restaurant_id" => 1,
                "course_id" => 4,
                "ingredients" => "Patate, olio di semi di Girasole, sale",
                "description" => "",
                "available" => true,
            ],

            [
                "name" => "Tiramisù",
                "price" => 4.50,
                "image" => "tiramisu.jpg",
                "restaurant_id" => 1,
                "course_id" => 5,
                "ingredients" => "Uova, caffè, mascarpone, zucchero, cacao",
                "description" => "Il tricolore nel cacao",
                "available" => true,
            ],

            [
                "name" => "Sprite",
                "price" => 2.50,
                "image" => "sprite.png",
                "restaurant_id" => 1,
                "course_id" => 6,
                "ingredients" => "...",
                "description" => "",
                "available" => true,
            ],

            //Fratelli Labufala

            [
                "name" => "Bistecca di Manzo",
                "price" => 7.50,
                "image" => "bistecca-manzo.jpg",
                "restaurant_id" => 2,
                "course_id" => 3,
                "ingredients" => "Pomodoro, mozzarella, basilico",
                "description" => "La classica pizza italiana con pomodoro, mozzarella e basilico fresco.",
                "available" => true,
            ],
            [
                "name" => "Risotto ai Funghi Porcini",
                "price" => 12.00,
                "image" => "riso-porcini.webp",
                "restaurant_id" => 2,
                "course_id" => 2,
                "ingredients" => "Riso carnaroli, funghi porcini, brodo di carne, burro, parmigiano",
                "description" => "Risotto cremoso con funghi porcini freschi e parmigiano.",
                "available" => true,
            ],

            //Old Wild West

            [
                "name" => "The Cowboy Burger",
                "price" => 9.50,
                "image" => "cowboy-burger.jpg",
                "restaurant_id" => 3,
                "course_id" => 2,
                "ingredients" => "Hamburger di manzo, formaggio cheddar, bacon, cipolla, salsa barbecue",
                "description" => "Hamburger succulento con formaggio fuso, bacon croccante e salsa barbecue.",
                "available" => true,
            ],
            [
                "name" => "Chili Cheese Fries",
                "price" => 5.50,
                "image" => "chili-fries.jpg",
                "restaurant_id" => 3,
                "course_id" => 4,
                "ingredients" => "Patatine fritte, chili con carne, formaggio fuso",
                "description" => "Patatine fritte coperte con chili con carne e formaggio fuso.",
                "available" => true,
            ],

            //I Love poke

            [
                "name" => "Poke Bowl al Salmone",
                "price" => 14.50,
                "image" => "poke-salmone.png",
                "restaurant_id" => 4,
                "course_id" => 2,
                "ingredients" => "Salmone fresco, avocado, edamame, alghe, riso",
                "description" => "Bowl di poke con salmone fresco, avocado e riso, arricchito con edamame e alghe.",
                "available" => true,
            ],
            [
                "name" => "Maki Sushi Assortiti",
                "price" => 10.00,
                "image" => "maki-suhi.webp",
                "restaurant_id" => 4,
                "course_id" => 3,
                "ingredients" => "Salmone, tonno, avocado, cetriolo, riso, alga nori",
                "description" => "Assortimento di maki sushi con salmone, tonno, avocado e cetriolo.",
                "available" => true,
            ],

            //Mc Donald

            [
                "name" => "Big Mac",
                "price" => 5.50,
                "image" => "big-mac.jpg",
                "restaurant_id" => 5,
                "course_id" => 2,
                "ingredients" => "Hamburger, formaggio, insalata, salsa speciale, cetriolini",
                "description" => "Hamburger con due hamburger di manzo, formaggio fuso, insalata, salsa speciale e cetriolini.",
                "available" => true,
            ],
            [
                "name" => "McNuggets",
                "price" => 4.00,
                "image" => "mcnuggets.jpg",
                "restaurant_id" => 5,
                "course_id" => 4,
                "ingredients" => "Petti di pollo, panatura croccante",
                "description" => "Petti di pollo croccanti con panatura speciale.",
                "available" => true,
            ],
            //La Scogliera

            [
                "name" => "Insalata di Mare",
                "price" => 11.50,
                "image" => "insalata-mare.avif",
                "restaurant_id" => 6,
                "course_id" => 3,
                "ingredients" => "Calamari, gamberi, cozze, limone, olio extravergine di oliva",
                "description" => "Insalata mista di frutti di mare con calamari, gamberi, cozze, condita con succo di limone e olio extravergine di oliva.",
                "available" => true,
            ],
            [
                "name" => "Branzino al Cartoccio",
                "price" => 16.00,
                "image" => "branzino-cartoccio.jpg",
                "restaurant_id" => 6,
                "course_id" => 3,
                "ingredients" => "Branzino, olive, pomodorini, capperi, origano, olio extravergine di oliva",
                "description" => "Branzino intero cotto al cartoccio con olive, pomodorini, capperi, origano e olio extravergine di oliva.",
                "available" => true,
            ],

            [
                "name" => "Spaghetti alle Vongole",
                "price" => 13.50,
                "image" => "spaghetti-vongole.jpg",
                "restaurant_id" => 6,
                "course_id" => 2,
                "ingredients" => "Spaghetti, vongole veraci, aglio, prezzemolo, peperoncino",
                "description" => "Spaghetti conditi con vongole veraci, aglio, prezzemolo e peperoncino.",
                "available" => true,
            ],

            //La Muraglia

            [
                "name" => "Pollo alle Mandorle",
                "price" => 9.50,
                "image" => "pollo-mandorle.avif",
                "restaurant_id" => 7,
                "course_id" => 3,
                "ingredients" => "Pollo, mandorle, peperoni, cipolle, salsa di soia",
                "description" => "Piatto tradizionale cinese con pezzi di pollo e mandorle, servito con peperoni e cipolle in salsa di soia.",
                "available" => true,
            ],
            [
                "name" => "Gamberi in Salsa Agrodolce",
                "price" => 12.00,
                "image" => "gamberi-agrodolce.jpg",
                "restaurant_id" => 7,
                "course_id" => 3,
                "ingredients" => "Gamberi, peperoni, ananas, cipolla, salsa agrodolce",
                "description" => "Gamberi croccanti con peperoni, ananas e cipolla in salsa agrodolce.",
                "available" => true,
            ],

            //Sushiko

            [
                "name" => "Sashimi Misto",
                "price" => 18.00,
                "image" => "sashimi-misto.jpg",
                "restaurant_id" => 8,
                "course_id" => 3,
                "ingredients" => "Salmone, tonno, branzino, avocado",
                "description" => "Assortimento di sashimi freschi di salmone, tonno, branzino e avocado.",
                "available" => true,
            ],
            [
                "name" => "Tempura Mista",
                "price" => 14.00,
                "image" => "tempura-mista.jpg",
                "restaurant_id" => 8,
                "course_id" => 3,
                "ingredients" => "Gamberi, verdure, salsa tempura",
                "description" => "Assortimento di tempura croccante con gamberi e verdure, servito con salsa tempura.",
                "available" => true,
            ],



        ];

        foreach ($dishes as $dish) {
            $new_dish = new Dish();

            // Assegno massivamente i valori alla nuova istanza di dish
            $new_dish->fill($dish);

            // Salvo le modifiche
            $new_dish->save();

            // Se c'è un'immagine, sposta l'immagine nella directory di storage e aggiorna il percorso nel database
            if (!empty($dish['image'])) {
                $imageName = $dish['image'];
                $imagePath = public_path('img/dish_img/' . $imageName);
                $newImagePath = 'dish_images/' . $imageName;
                Storage::put($newImagePath, file_get_contents($imagePath));
                $new_dish->image = $newImagePath;
                $new_dish->save();
            }
        }
    }
}
