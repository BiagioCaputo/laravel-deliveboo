<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();

        $this->call(CourseSeeder::class);

        $this->call(RestaurantSeeder::class);


        \App\Models\User::factory()->create([
            'name' => 'Team4',
            'email' => 'team4@esempio.com',
        ]);
    }
}
