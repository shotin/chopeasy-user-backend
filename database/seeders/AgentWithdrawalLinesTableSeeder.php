<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentWithdrawalLinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agent_withdrawal_lines')->delete();
        
        
        
    }
}