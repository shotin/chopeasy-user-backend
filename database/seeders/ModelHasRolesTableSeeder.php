<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_roles')->delete();
        
        \DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 5,
            ),
            2 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 25,
            ),
            3 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 26,
            ),
            4 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2,
            ),
            5 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 6,
            ),
            6 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3,
            ),
            7 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 7,
            ),
            8 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 8,
            ),
            9 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 9,
            ),
            10 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 10,
            ),
            11 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 11,
            ),
            12 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 12,
            ),
            13 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 13,
            ),
            14 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 14,
            ),
            15 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 15,
            ),
            16 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 16,
            ),
            17 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 18,
            ),
            18 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 19,
            ),
            19 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 20,
            ),
            20 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 21,
            ),
            21 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 22,
            ),
            22 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 23,
            ),
            23 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 24,
            ),
            24 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 27,
            ),
        ));
        
        
    }
}