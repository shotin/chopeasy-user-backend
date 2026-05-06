<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentCustomerNotificationPrefsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agent_customer_notification_prefs')->delete();
        
        \DB::table('agent_customer_notification_prefs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'agent_id' => 25,
                'customer_user_id' => 7,
                'notify_inactive' => 1,
                'notify_incomplete_onboarding' => 1,
                'created_at' => '2026-04-16 07:10:13',
                'updated_at' => '2026-04-17 17:21:01',
            ),
        ));
        
        
    }
}