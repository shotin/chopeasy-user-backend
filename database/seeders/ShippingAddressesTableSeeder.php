<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_addresses')->delete();
        
        \DB::table('shipping_addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'session_id' => '53bae5d9-e9cb-400f-b663-d7264c9987d5',
                'user_id' => NULL,
                'address_line_1' => '334343',
                'address_line_2' => NULL,
                'city' => NULL,
                'state' => NULL,
                'country' => 'Nigeria',
                'postal_code' => '90909090',
                'is_default' => 1,
                'created_at' => '2025-11-08 12:46:48',
                'updated_at' => '2025-11-08 12:46:48',
                'first_name' => 'aaaaa',
                'last_name' => 'bbbb',
                'phone_number' => '343434',
                'email' => 'olushola@gmail.com',
            ),
        ));
        
        
    }
}