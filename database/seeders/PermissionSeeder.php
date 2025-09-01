<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage users',
            'create users',
            'edit users',
            'delete users',
            'view dashboard',
            'place orders',
            'view orders',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $customer = Role::firstOrCreate(['name' => 'Customer']);
        $guest = Role::firstOrCreate(['name' => 'Guest']);

        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'manage users',
            'create users',
            'edit users',
            'view dashboard'
        ]);

        $customer->syncPermissions([
            'place orders',
            'view orders'
        ]);

        $guest->syncPermissions([]);
    }
}
