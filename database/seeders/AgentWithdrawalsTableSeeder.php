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
        
      
    }
}