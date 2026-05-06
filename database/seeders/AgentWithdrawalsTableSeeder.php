<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentWithdrawalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agent_withdrawals')->delete();
        
        \DB::table('agent_withdrawals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'agent_id' => 25,
                'amount' => '6000.00',
                'status' => 'approved',
            'bank_name' => 'OPay Digital Services Limited (OPay)',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'created_at' => '2026-03-19 13:17:36',
                'updated_at' => '2026-03-19 20:46:53',
            ),
            1 => 
            array (
                'id' => 2,
                'agent_id' => 19,
                'amount' => '5000.00',
                'status' => 'approved',
                'bank_name' => '',
                'bank_code' => '999992',
                'account_number' => '7032768960',
                'account_name' => 'OLUSHOLA WALE ILESANMI',
                'created_at' => '2026-03-27 08:27:48',
                'updated_at' => '2026-03-27 16:50:52',
            ),
            2 => 
            array (
                'id' => 3,
                'agent_id' => 25,
                'amount' => '9000.00',
                'status' => 'approved',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-12 15:24:00',
                'updated_at' => '2026-04-12 15:25:16',
            ),
            3 => 
            array (
                'id' => 4,
                'agent_id' => 25,
                'amount' => '9000.00',
                'status' => 'rejected',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-12 15:24:18',
                'updated_at' => '2026-04-12 15:24:42',
            ),
            4 => 
            array (
                'id' => 5,
                'agent_id' => 25,
                'amount' => '1000.00',
                'status' => 'rejected',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-17 21:02:25',
                'updated_at' => '2026-04-17 21:04:21',
            ),
            5 => 
            array (
                'id' => 6,
                'agent_id' => 25,
                'amount' => '2000.00',
                'status' => 'rejected',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-17 21:02:55',
                'updated_at' => '2026-04-17 21:04:14',
            ),
            6 => 
            array (
                'id' => 7,
                'agent_id' => 25,
                'amount' => '3000.00',
                'status' => 'approved',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-17 21:05:58',
                'updated_at' => '2026-04-17 21:30:06',
            ),
            7 => 
            array (
                'id' => 8,
                'agent_id' => 25,
                'amount' => '5000.00',
                'status' => 'pending',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-18 18:03:26',
                'updated_at' => '2026-04-18 18:03:26',
            ),
            8 => 
            array (
                'id' => 9,
                'agent_id' => 25,
                'amount' => '5000.00',
                'status' => 'pending',
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-25 17:44:15',
                'updated_at' => '2026-04-25 17:44:15',
            ),
        ));
        
        
    }
}