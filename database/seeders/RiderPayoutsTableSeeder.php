<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderPayoutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_payouts')->delete();
        
        \DB::table('rider_payouts')->insert(array (
            0 => 
            array (
                'id' => 2,
                'rider_id' => 13,
                'order_id' => 66,
                'amount' => '2994.50',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '232',
                'account_number' => '0070047711',
                'account_name' => 'ILESANMI OLUSHOLA WALE',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
            'failure_reason' => 'cURL error 6: Could not resolve host: api.paystack.co (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.paystack.co/transferrecipient',
                'paid_at' => NULL,
                'created_at' => '2026-04-04 14:17:22',
                'updated_at' => '2026-04-04 14:17:22',
            ),
            1 => 
            array (
                'id' => 3,
                'rider_id' => 13,
                'order_id' => 78,
                'amount' => '4496.00',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '232',
                'account_number' => '0070047711',
                'account_name' => 'ILESANMI OLUSHOLA WALE',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-12 20:38:07',
                'updated_at' => '2026-04-12 20:38:10',
            ),
            2 => 
            array (
                'id' => 4,
                'rider_id' => 13,
                'order_id' => 83,
                'amount' => '75148.40',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '232',
                'account_number' => '0070047711',
                'account_name' => 'ILESANMI OLUSHOLA WALE',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-28 10:59:17',
                'updated_at' => '2026-04-28 10:59:18',
            ),
        ));
        
        
    }
}