<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearLevel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('year_level')->insert([
            ['name' => 'First Year'],
            ['name' => 'Second Year'],
            ['name' => 'Third Year'],
            ['name' => 'Fourth Year'],
            ['name' => 'Fifth Year'],
            ['name' => 'Grade 11'],
            ['name' => 'Grade 12'],
            // Add more user types as needed
        ]);
    }
}
