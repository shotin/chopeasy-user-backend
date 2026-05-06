<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorBankDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor_bank_details')->delete();
        
        \DB::table('vendor_bank_details')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 19,
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'created_at' => '2026-04-05 12:01:04',
                'updated_at' => '2026-04-05 12:01:04',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 20,
                'bank_name' => '',
                'bank_code' => '232',
                'account_number' => '0070047711',
                'account_name' => 'ILESANMI OLUSHOLA WALE',
                'recipient_code' => NULL,
                'created_at' => '2026-04-28 09:23:34',
                'updated_at' => '2026-04-28 09:23:34',
            ),
        ));
        
        
    }
}