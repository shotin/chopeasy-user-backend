<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'fullname' => 'John Doe',
                'middlename' => 'A',
                'email' => 'superadmin@chopwell.com',
                'username' => 'superadmin',
                'phoneno' => '08012345678',
                'address' => '123 Admin Street',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'gender' => 'Male',
                'date_of_birth' => '1990-01-01',
                'is_verified' => 1,
                'is_active' => 1,
                'can_login' => 1,
                'password' => Hash::make('password'),
                'role' => 'Super Admin',
            ],
            [
                'fullname' => 'John Doe',
                'middlename' => 'B',
                'email' => 'admin@chopwell.com',
                'username' => 'admin',
                'phoneno' => '08098765432',
                'address' => '456 Admin Ave',
                'state' => 'Abuja',
                'country' => 'Nigeria',
                'gender' => 'Female',
                'date_of_birth' => '1992-05-10',
                'is_verified' => 1,
                'is_active' => 1,
                'can_login' => 1,
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ],
            [
                'fullname' => 'John Doe',
                'middlename' => 'C',
                'email' => 'customer@chopwell.com',
                'username' => 'customer1',
                'phoneno' => '08123456789',
                'address' => '789 Customer Rd',
                'state' => 'Kano',
                'country' => 'Nigeria',
                'gender' => 'Male',
                'date_of_birth' => '1995-09-15',
                'is_verified' => 1,
                'is_active' => 1,
                'can_login' => 1,
                'password' => Hash::make('password'),
                'role' => 'Customer',
            ],
        ];

        foreach ($users as $userData) {
            $roleName = $userData['role'];
            unset($userData['role']);

            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            $role = Role::firstOrCreate(['name' => $roleName]);

            $user->syncRoles([$role]);
        }
    }
}
