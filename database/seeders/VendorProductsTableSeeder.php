<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor_products')->delete();
        
        
        
    }
}