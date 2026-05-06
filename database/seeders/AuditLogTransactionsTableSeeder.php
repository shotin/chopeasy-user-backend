<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuditLogTransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('audit_log_transactions')->delete();
        
        \DB::table('audit_log_transactions')->insert(array (
            0 => 
            array (
                'id' => 6,
                'audit_log_id' => 6,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2025-08-03 10:13:25',
                'updated_at' => '2025-08-03 10:13:25',
            ),
            1 => 
            array (
                'id' => 7,
                'audit_log_id' => 7,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2025-08-03 16:08:09',
                'updated_at' => '2025-08-03 16:08:09',
            ),
            2 => 
            array (
                'id' => 9,
                'audit_log_id' => 9,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2025-08-05 22:16:02',
                'updated_at' => '2025-08-05 22:16:02',
            ),
            3 => 
            array (
                'id' => 11,
                'audit_log_id' => 11,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2025-09-19 15:22:08',
                'updated_at' => '2025-09-19 15:22:08',
            ),
            4 => 
            array (
                'id' => 12,
                'audit_log_id' => 12,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2025-09-19 16:39:21',
                'updated_at' => '2025-09-19 16:39:21',
            ),
            5 => 
            array (
                'id' => 17,
                'audit_log_id' => 17,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2026-01-12 15:16:17',
                'updated_at' => '2026-01-12 15:16:17',
            ),
            6 => 
            array (
                'id' => 18,
                'audit_log_id' => 18,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2026-01-12 15:58:24',
                'updated_at' => '2026-01-12 15:58:24',
            ),
            7 => 
            array (
                'id' => 19,
                'audit_log_id' => 19,
                'old_data' => '[]',
                'new_data' => '[]',
                'created_at' => '2026-04-28 09:03:30',
                'updated_at' => '2026-04-28 09:03:30',
            ),
        ));
        
        
    }
}