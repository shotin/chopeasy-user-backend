<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wishlists')->delete();
        
        \DB::table('wishlists')->insert(array (
            0 => 
            array (
                'id' => 5,
                'user_id' => 25,
                'session_id' => NULL,
                'product_id' => 14,
                'created_at' => '2026-04-03 17:38:01',
                'updated_at' => '2026-04-03 17:38:01',
            ),
        ));
        
        
    }
}