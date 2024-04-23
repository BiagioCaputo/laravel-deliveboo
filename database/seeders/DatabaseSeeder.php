<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(4)->create();

        $this->call(TypeSeeder::class);

        // $this->call(RestaurantSeeder::class);

        // $this->call(CourseSeeder::class);

        // \App\Models\Dish::factory(10)->create();

        // $this->call(DishSeeder::class);


        //     \App\Models\User::factory()->create([
        //         'name' => 'Team4',
        //         'email' => 'team4@esempio.com',
        //     ]);
    }
}
