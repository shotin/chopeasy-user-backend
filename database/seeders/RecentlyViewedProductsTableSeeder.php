<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecentlyViewedProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recently_viewed_products')->delete();
        
        
        
    }
}