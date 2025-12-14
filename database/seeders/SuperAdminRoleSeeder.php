<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
// use App\Models\User;

// class SuperAdminRoleSeeder extends Seeder
// {
//     public function run(): void
//     {
//         // Create Full Access Permission if not exists
//         $fullAccessPermission = Permission::firstOrCreate(['name' => 'FullAccess']);

//         // Create Super Admin Role if not exists
//         $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

//         // Assign Full Access Permission to Super Admin Role
//         if (!$superAdminRole->hasPermissionTo('FullAccess')) {
//             $superAdminRole->givePermissionTo($fullAccessPermission);
//         }

//         // Assign Super Admin Role to User ID 1
//         $superAdminUser = User::find(1);
//         if ($superAdminUser && !$superAdminUser->hasRole('Super Admin')) {
//             $superAdminUser->assignRole($superAdminRole);
//         }

//         $this->command->info('Super Admin Role & FullAccess permission assigned to User ID 1.');
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class SuperAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'admin';

        // Create Full Access Permission for admin guard
        $fullAccessPermission = Permission::firstOrCreate([
            'name'       => 'FullAccess',
            'guard_name' => $guard,
        ]);

        // Create Super Admin Role for admin guard
        $superAdminRole = Role::firstOrCreate([
            'name'       => 'Super Admin',
            'guard_name' => $guard,
        ]);

        // Assign permission to role
        if (! $superAdminRole->hasPermissionTo($fullAccessPermission)) {
            $superAdminRole->givePermissionTo($fullAccessPermission);
        }

        // Assign role to Admin ID 1
        $superAdminAdmin = Admin::find(1);
        if ($superAdminAdmin && ! $superAdminAdmin->hasRole('Super Admin')) {
            $superAdminAdmin->assignRole($superAdminRole);
        }

        $this->command->info('Super Admin role & FullAccess permission assigned (admin guard).');
    }
}
