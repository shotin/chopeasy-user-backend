<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'manage users',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'create users',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'edit users',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'delete users',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'view dashboard',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'place orders',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'view orders',
                'guard_name' => 'web',
                'created_at' => '2025-07-30 12:43:43',
                'updated_at' => '2025-07-30 12:43:43',
            ),
        ));
        
        
    }
}