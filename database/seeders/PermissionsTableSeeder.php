<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'view-medical-records',
            'edit-medical-records',
            'view-dashboard',
            'make-announcements',
            'edit-announcements',
            'make-healthform',
            'view-checkups',
            'doctor-checkups',
            'manage-pending-appointments',
            'nurse-pending-appointments',
            'doctor-pending-appointments',
            'nurse-history-appointments',
            'doctor-history-appointments',
            'view-appointments',
            'view-appointment-history',
            'manage-roles-and-permissions',
            'manage-staff-schedule',
            'manage-users',
            'access-maintenance',
            'nurse-checkups',
            'nurse-all-checkups',
            'doctor-all-checkups',
            'all-checkups',
            'staff-dashboard',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
