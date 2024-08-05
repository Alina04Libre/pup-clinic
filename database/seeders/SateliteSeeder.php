<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SateliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('satelite')->insert([
            ['name' => 'MAIN'],
            ['name' => 'CEA'],
            ['name' => 'ITECH'],
            ['name' => 'COC'],
            ['name' => 'HASMIN'],
            // Add more user types as needed
        ]);
    }
}
