<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor_profiles')->delete();
        
        \DB::table('vendor_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'vendor_id' => 19,
                'description' => NULL,
                'store_type' => NULL,
                'delivery_time' => NULL,
                'logo' => NULL,
                'latitude' => NULL,
                'longitude' => NULL,
                'created_at' => '2025-09-20 05:12:26',
                'updated_at' => '2025-09-20 05:12:26',
            ),
        ));
        
        
    }
}