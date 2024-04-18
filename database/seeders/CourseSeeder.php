<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = ["antipasto", "primo", "secondo", "contorno", "dolce", "bevanda"];

        foreach ($courses as $course) {

            $newCourse = new Course();
            $newCourse->label = $course;
            $newCourse->save();
        }
    }
}
