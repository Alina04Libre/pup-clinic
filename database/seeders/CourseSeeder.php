<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('course')->insert([
            ['course_name' => 'Bachelor of Science in information Technology',  'abbreviation' => 'BSIT'],
            ['course_name' => 'Bachelor of Science in Office Administration', 'abbreviation' => 'BSOA'],
            ['course_name' => 'Bachelor of Public Administration', 'abbreviation' => 'BPA'],
            ['course_name' => 'Bachelor of Science in Computer Science', 'abbreviation' => 'BSCS'],
        ]);
    }
}
