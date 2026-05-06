<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderBankDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_bank_details')->delete();
        
        \DB::table('rider_bank_details')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 13,
                'bank_name' => '',
                'bank_code' => '232',
                'account_number' => '0070047711',
                'account_name' => 'ILESANMI OLUSHOLA WALE',
                'recipient_code' => NULL,
                'created_at' => '2026-04-04 00:10:56',
                'updated_at' => '2026-04-04 00:10:56',
            ),
        ));
        
        
    }
}