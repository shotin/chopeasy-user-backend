<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuditLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('audit_logs')->delete();
        
        \DB::table('audit_logs')->insert(array (
            0 => 
            array (
                'id' => 6,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 13,
                'action_id' => 13,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2025-08-03 10:13:25',
                'updated_at' => '2025-08-03 10:13:25',
            ),
            1 => 
            array (
                'id' => 7,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 14,
                'action_id' => 14,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2025-08-03 16:08:09',
                'updated_at' => '2025-08-03 16:08:09',
            ),
            2 => 
            array (
                'id' => 9,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 16,
                'action_id' => 16,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2025-08-05 22:16:02',
                'updated_at' => '2025-08-05 22:16:02',
            ),
            3 => 
            array (
                'id' => 11,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 19,
                'action_id' => 19,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2025-09-19 15:22:08',
                'updated_at' => '2025-09-19 15:22:08',
            ),
            4 => 
            array (
                'id' => 12,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 20,
                'action_id' => 20,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2025-09-19 16:39:21',
                'updated_at' => '2025-09-19 16:39:21',
            ),
            5 => 
            array (
                'id' => 17,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 25,
                'action_id' => 25,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2026-01-12 15:16:17',
                'updated_at' => '2026-01-12 15:16:17',
            ),
            6 => 
            array (
                'id' => 18,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 26,
                'action_id' => 26,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2026-01-12 15:58:24',
                'updated_at' => '2026-01-12 15:58:24',
            ),
            7 => 
            array (
                'id' => 19,
                'action_type' => 'App\\Models\\User',
                'causer_id' => 27,
                'action_id' => 27,
                'log_name' => 'User registered successfully and email sent for verification',
                'description' => '  added successfully',
                'created_at' => '2026-04-28 09:03:30',
                'updated_at' => '2026-04-28 09:03:30',
            ),
        ));
        
        
    }
}