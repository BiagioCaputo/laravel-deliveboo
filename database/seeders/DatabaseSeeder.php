<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(8)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Team4',
        //     'email' => 'team4@esempio.com',
        // ]);
        $users = [
            [
                'name' => 'Pizzeria owner',
                'email' => 'pizzeria_sorbillo@esempio.com',
            ],
            [
                'name' => 'Labufala owner',
                'email' => 'fratelli_labufala@esempio.com',
            ],
            [
                'name' => 'Old owner',
                'email' => 'old_wild_west@esempio.com',
            ],
            [
                'name' => 'Poke Owner',
                'email' => 'i_love_poke@esempio.com',
            ],
            [
                'name' => 'Mc Owner',
                'email' => 'mc_donald@esempio.com',
            ],
            [
                'name' => 'La Scogliera owner',
                'email' => 'la_scogliera@esempio.com',
            ],
            [
                'name' => 'La Muraglia owner',
                'email' => 'la_muraglia@esempio.com',
            ],
            [
                'name' => 'Sushiko owner',
                'email' => 'sushiko@esempio.com',
            ],
        ];

        // Itera sull'array per creare gli utenti
        foreach ($users as $user) {
            User::factory()->create($user);
        }

        $this->call(TypeSeeder::class);

        $this->call(RestaurantSeeder::class);

        $this->call(CourseSeeder::class);

        //\App\Models\Dish::factory(10)->create();

        $this->call(DishSeeder::class);

        \App\Models\Order::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Team4',
        //     'email' => 'team4@esempio.com',
        // ]);
    }
}
