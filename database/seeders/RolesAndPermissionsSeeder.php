<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $doctorRole = Role::where('name', 'doctor')->first(); 
        $nurseRole = Role::where('name', 'nurse')->first();
        // $userRole = Role::where('name', 'regular_user')->first();
        
        // Retrieve the permissions you created in PermissionsTableSeeder
        $permissions = Permission::whereIn('name', [
            'view-medical-records',
            'edit-medical-records',
            'view-dashboard',
            'edit-announcements',
            'make-announcements',
            'make-healthform',
            'view-checkups',
            'manage-pending-appointments',
            'view-appointment-history',
            'view-appointments',
            'manage-roles-and-permissions',
            'manage-staff-schedule',
            'manage-users',
            'access-maintenance',
            'all-checkups',
            // Add more permissions as needed
        ])->get();

        // Assign permissions to roles
        // $userRole->syncPermissions([
        //     'access-navbar',
        //     'access-footer',
        //     // Add or remove permissions as needed
        // ]);
        $superAdminRole->syncPermissions($permissions);
        $adminRole->syncPermissions([
            'manage-pending-appointments',
            'view-dashboard',
            'view-appointment-history',
            'make-announcements',
            // Add or remove permissions as needed
        ]);
        $doctorRole->syncPermissions([
            'view-medical-records',
            'doctor-pending-appointments',
            'view-dashboard',
            'doctor-checkups',
            'doctor-all-checkups',
            'doctor-history-appointments',
            'staff-dashboard',
            // Add or remove permissions as needed
        ]);
        $nurseRole->syncPermissions([
            'view-medical-records',
            'view-dashboard',
            'nurse-checkups',
            'nurse-all-checkups',
            'nurse-pending-appointments',
            'nurse-history-appointments',
            'staff-dashboard',
            // Add or remove permissions as needed
        ]);
    }
}

