<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ErrorLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('error_logs')->delete();
           
    }
}