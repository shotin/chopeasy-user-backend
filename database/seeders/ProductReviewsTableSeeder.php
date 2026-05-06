<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_reviews')->delete();
        
        \DB::table('product_reviews')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 190,
                'user_id' => 25,
                'session_id' => NULL,
                'name' => 'Olushola Ilesanmi',
                'email' => 'ilesanmiolushola9@gmail.com',
                'title' => '',
                'review' => '',
                'rating' => 4,
                'created_at' => '2026-01-14 07:44:02',
                'updated_at' => '2026-01-14 07:44:02',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 23,
                'user_id' => 25,
                'session_id' => NULL,
                'name' => 'Olushola Ilesanmi',
                'email' => 'ilesanmiolushola9@gmail.com',
                'title' => 'Nice product',
                'review' => 'nice perfume',
                'rating' => 4,
                'created_at' => '2026-01-14 07:49:57',
                'updated_at' => '2026-01-14 07:49:57',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 247,
                'user_id' => 25,
                'session_id' => NULL,
                'name' => 'Olushola Ilesanmi',
                'email' => 'ilesanmiolushola9@gmail.com',
                'title' => 'Nice meal',
                'review' => 'I love this maltina',
                'rating' => 5,
                'created_at' => '2026-02-06 17:15:05',
                'updated_at' => '2026-02-06 17:15:05',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 229,
                'user_id' => 25,
                'session_id' => NULL,
                'name' => 'Olushola Ilesanmi',
                'email' => 'ilesanmiolushola9@gmail.com',
                'title' => 'Best pasra',
                'review' => 'Children favorite',
                'rating' => 5,
                'created_at' => '2026-02-14 12:50:15',
                'updated_at' => '2026-02-14 12:50:15',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 405,
                'user_id' => 25,
                'session_id' => NULL,
                'name' => 'Olushola Ilesanmi',
                'email' => 'ilesanmiolushola9@gmail.com',
                'title' => 'Nice Rice',
                'review' => 'Nice',
                'rating' => 4,
                'created_at' => '2026-04-04 14:12:07',
                'updated_at' => '2026-04-04 14:12:07',
            ),
        ));
        
        
    }
}