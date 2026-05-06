<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentBankDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agent_bank_details')->delete();
        
        \DB::table('agent_bank_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 25,
                'bank_name' => 'STERLING BANK',
                'bank_code' => '009',
                'account_number' => '0070047711',
                'account_name' => 'olushola wale',
                'created_at' => '2026-04-12 16:21:02',
                'updated_at' => '2026-04-12 16:21:07',
            ),
        ));
        
        
    }
}