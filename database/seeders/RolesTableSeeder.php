<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\UserType;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the "superadmin" role
        Role::create(['name' => 'superadmin']);

        // Create the "admin" role
        Role::create(['name' => 'admin']);

        // Create the "doctor" role
        Role::create(['name' => 'doctor']);

        // Create the "nurse" role
        Role::create(['name' => 'nurse']);

        // Create the "regular_user" role
        Role::create(['name' => 'regular_user']);
        
        //
        // $userTypeRoleMapping = [
        //     'superadmin' => 'superadmin', // User type 'superadmin' maps to role 'superadmin'
        //     'admin' => 'admin',           // User type 'admin' maps to role 'admin'
        //     'doctor' => 'doctor',         // User type 'doctor' maps to role 'doctor'
        //     'nurse' => 'nurse',           // User type 'nurse' maps to role 'nurse'
        //     'regular user' => 'user',    // User type 'regular user' maps to role 'user' (customize as needed)
        // ];

        // foreach ($userTypeRoleMapping as $userTypeName => $roleName) {
        //     $userType = UserType::where('name', $userTypeName)->first();
            
        //     if ($userType) {
        //         // Create a role based on the role name
        //         $role = Role::create(['name' => $roleName]);

        //         // Attach the role to the user type
        //         $userType->roles()->attach($role);
        //     }
        // }
    }
}
