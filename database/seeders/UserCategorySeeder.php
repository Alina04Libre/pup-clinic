<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_category')->insert([
            ['name' => 'Student'],
            ['name' => 'Faculty'],
            ['name' => 'Employee'],
            // Add more user types as needed
        ]);
    }
}
