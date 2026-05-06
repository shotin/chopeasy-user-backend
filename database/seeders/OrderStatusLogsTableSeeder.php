<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_status_logs')->delete();
        
        \DB::table('order_status_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 63,
                'status' => 'delivered',
                'message' => 'Order delivered and confirmed by customer.',
                'fulfilled_at' => '2026-04-04 12:25:54',
                'created_at' => '2026-04-04 12:25:54',
                'updated_at' => '2026-04-04 12:25:54',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 66,
                'status' => 'delivered',
                'message' => 'Order delivered and confirmed by customer.',
                'fulfilled_at' => '2026-04-04 14:17:22',
                'created_at' => '2026-04-04 14:17:22',
                'updated_at' => '2026-04-04 14:17:22',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 78,
                'status' => 'delivered',
                'message' => 'Order delivered and confirmed by customer.',
                'fulfilled_at' => '2026-04-12 20:38:07',
                'created_at' => '2026-04-12 20:38:07',
                'updated_at' => '2026-04-12 20:38:07',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 83,
                'status' => 'delivered',
                'message' => 'Order delivered and confirmed by customer.',
                'fulfilled_at' => '2026-04-28 10:59:17',
                'created_at' => '2026-04-28 10:59:17',
                'updated_at' => '2026-04-28 10:59:17',
            ),
        ));
        
        
    }
}