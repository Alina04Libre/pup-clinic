<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('strand')->insert([
            ['name' => 'Science, Technology, Engineering and Mathematics', 'abbreviation' => 'STEM'],
            ['name' => 'Accountancy, Business and Management Strand', 'abbreviation' => 'ABM'],
            ['name' => 'Humanities and Social Sciences Strand', 'abbreviation' => 'HUMSS'],
            ['name' => 'Information Communications Technology', 'abbreviation' => 'ICT'],
            // Add more user types as needed
        ]);
    }
}
