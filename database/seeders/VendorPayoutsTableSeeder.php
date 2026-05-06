<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorPayoutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor_payouts')->delete();
        
        \DB::table('vendor_payouts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'vendor_id' => 19,
                'order_id' => 63,
                'amount' => '5879.02',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-04 12:25:54',
                'updated_at' => '2026-04-05 12:01:05',
            ),
            1 => 
            array (
                'id' => 2,
                'vendor_id' => 19,
                'order_id' => 66,
                'amount' => '15519.03',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-04 14:17:22',
                'updated_at' => '2026-04-05 12:01:06',
            ),
            2 => 
            array (
                'id' => 3,
                'vendor_id' => 19,
                'order_id' => 67,
                'amount' => '21338.06',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-04 15:26:44',
                'updated_at' => '2026-04-05 12:01:08',
            ),
            3 => 
            array (
                'id' => 4,
                'vendor_id' => 19,
                'order_id' => 78,
                'amount' => '103789.03',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-12 20:36:21',
                'updated_at' => '2026-04-12 20:36:22',
            ),
            4 => 
            array (
                'id' => 5,
                'vendor_id' => 19,
                'order_id' => 83,
                'amount' => '149470.21',
                'status' => 'failed',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'recipient_code' => NULL,
                'transfer_code' => NULL,
                'transfer_reference' => NULL,
                'failure_reason' => 'Transfer recipient created successfully',
                'paid_at' => NULL,
                'created_at' => '2026-04-28 10:51:51',
                'updated_at' => '2026-04-28 10:51:53',
            ),
            5 => 
            array (
                'id' => 6,
                'vendor_id' => 20,
                'order_id' => 83,
                'amount' => '21146.00',
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
                'created_at' => '2026-04-28 10:51:53',
                'updated_at' => '2026-04-28 10:51:54',
            ),
        ));
        
        
    }
}