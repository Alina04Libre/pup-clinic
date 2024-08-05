<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('branch')->insert([
            ['name' => 'Mabini'],
            ['name' => 'NDC Compound'],
            ['name' => 'M.H. Del Pilar'],
            // Add more user types as needed
        ]);
    }
}
