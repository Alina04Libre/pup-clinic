<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('school_year')->insert([
            ['name' => '2020-2021'],
            ['name' => '2021-2022'],
            ['name' => '2022-2023'],
            ['name' => '2023-2024'],
            ['name' => '2024-2025'],
            // Add more user types as needed
        ]);
    }
}
