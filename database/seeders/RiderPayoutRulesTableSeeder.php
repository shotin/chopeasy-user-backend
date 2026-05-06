<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderPayoutRulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_payout_rules')->delete();
        
        \DB::table('rider_payout_rules')->insert(array (
            0 => 
            array (
                'id' => 9,
                'min_distance' => '0.00',
                'zone_name' => 'Zone A',
                'max_distance' => '5.00',
                'flat_payout' => '0.00',
                'weight_limit' => '10.00',
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:08:05',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 10,
                'min_distance' => '6.00',
                'zone_name' => 'Zone B',
                'max_distance' => '10.00',
                'flat_payout' => '500.00',
                'weight_limit' => '20.00',
                'additional_per_km' => '60.00',
                'additional_per_kg' => '25.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 2,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:14:04',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 11,
                'min_distance' => '16.00',
                'zone_name' => 'Zone D',
                'max_distance' => '20.00',
                'flat_payout' => '1500.00',
                'weight_limit' => '30.00',
                'additional_per_km' => '80.00',
                'additional_per_kg' => '35.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 3,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:14:18',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 12,
                'min_distance' => '0.00',
                'zone_name' => NULL,
                'max_distance' => '999.00',
                'flat_payout' => '2000.00',
                'weight_limit' => '50.00',
                'additional_per_km' => '100.00',
                'additional_per_kg' => '50.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'priority' => 4,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:10:38',
                'deleted_at' => '2026-03-19 20:10:38',
            ),
            4 => 
            array (
                'id' => 13,
                'min_distance' => '0.00',
                'zone_name' => NULL,
                'max_distance' => '5.00',
                'flat_payout' => '500.00',
                'weight_limit' => '10.00',
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'priority' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:10:48',
                'deleted_at' => '2026-03-19 20:10:48',
            ),
            5 => 
            array (
                'id' => 14,
                'min_distance' => '0.00',
                'zone_name' => NULL,
                'max_distance' => '10.00',
                'flat_payout' => '800.00',
                'weight_limit' => '20.00',
                'additional_per_km' => '50.00',
                'additional_per_kg' => '20.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'priority' => 2,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:11:01',
                'deleted_at' => '2026-03-19 20:11:01',
            ),
            6 => 
            array (
                'id' => 15,
                'min_distance' => '0.00',
                'zone_name' => NULL,
                'max_distance' => '20.00',
                'flat_payout' => '1200.00',
                'weight_limit' => '30.00',
                'additional_per_km' => '60.00',
                'additional_per_kg' => '30.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'priority' => 3,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:11:14',
                'deleted_at' => '2026-03-19 20:11:14',
            ),
            7 => 
            array (
                'id' => 16,
                'min_distance' => '0.00',
                'zone_name' => NULL,
                'max_distance' => '999.00',
                'flat_payout' => '1500.00',
                'weight_limit' => '50.00',
                'additional_per_km' => '80.00',
                'additional_per_kg' => '40.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'priority' => 4,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:11:20',
                'deleted_at' => '2026-03-19 20:11:20',
            ),
            8 => 
            array (
                'id' => 17,
                'min_distance' => '0.00',
                'zone_name' => 'Zone A',
                'max_distance' => '5.00',
                'flat_payout' => '0.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 1,
                'created_at' => '2026-03-19 19:38:35',
                'updated_at' => '2026-03-19 20:11:25',
                'deleted_at' => '2026-03-19 20:11:25',
            ),
            9 => 
            array (
                'id' => 18,
                'min_distance' => '5.00',
                'zone_name' => 'Zone B',
                'max_distance' => '10.00',
                'flat_payout' => '500.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 2,
                'created_at' => '2026-03-19 19:38:35',
                'updated_at' => '2026-03-19 20:11:56',
                'deleted_at' => '2026-03-19 20:11:56',
            ),
            10 => 
            array (
                'id' => 19,
                'min_distance' => '11.00',
                'zone_name' => 'Zone C',
                'max_distance' => '15.00',
                'flat_payout' => '1000.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 3,
                'created_at' => '2026-03-19 19:38:35',
                'updated_at' => '2026-03-19 20:14:11',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 20,
                'min_distance' => '15.00',
                'zone_name' => 'Zone E',
                'max_distance' => '20.00',
                'flat_payout' => '2000.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 4,
                'created_at' => '2026-03-19 19:38:35',
                'updated_at' => '2026-03-19 20:14:45',
                'deleted_at' => '2026-03-19 20:14:45',
            ),
            12 => 
            array (
                'id' => 21,
                'min_distance' => '21.00',
                'zone_name' => 'Zone E',
                'max_distance' => '25.00',
                'flat_payout' => '2000.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 5,
                'created_at' => '2026-03-19 19:38:35',
                'updated_at' => '2026-03-19 20:16:00',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 22,
                'min_distance' => '26.00',
                'zone_name' => 'Zone F',
                'max_distance' => '30.00',
                'flat_payout' => '2500.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 6,
                'created_at' => '2026-03-19 20:13:45',
                'updated_at' => '2026-03-19 20:16:10',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 23,
                'min_distance' => '30.00',
                'zone_name' => 'Zone G',
                'max_distance' => NULL,
                'flat_payout' => '3000.00',
                'weight_limit' => NULL,
                'additional_per_km' => '0.00',
                'additional_per_kg' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'priority' => 7,
                'created_at' => '2026-03-20 20:26:50',
                'updated_at' => '2026-03-20 20:26:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}