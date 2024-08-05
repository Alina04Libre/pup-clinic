<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('department')->insert([
            ['name' => 'College of Accountancy and Finance', 'abbreviation' => 'CAF'],
            ['name' => 'College of Business Administration', 'abbreviation' => 'CBA'],
            ['name' => 'College of Political Science and Public Administration', 'abbreviation' => 'CPSPA'],
            ['name' => 'College of Computer and Information Sciences', 'abbreviation' => 'CCIS'],
            // Add more user types as needed
        ]);
    }
}
