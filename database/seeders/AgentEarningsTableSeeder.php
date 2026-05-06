<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentEarningsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agent_earnings')->delete();
        
        \DB::table('agent_earnings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'agent_id' => 25,
                'order_id' => 78,
                'earning_type' => 'customer_order',
                'referred_user_id' => 25,
                'order_amount' => '121317.33',
                'commission_percent' => '15.00',
                'amount' => '18197.60',
                'status' => 'credited',
                'withdrawal_id' => NULL,
                'created_at' => '2026-04-12 20:38:10',
                'updated_at' => '2026-04-12 20:38:10',
            ),
        ));
        
        
    }
}