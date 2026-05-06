<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WeightTiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('weight_tiers')->delete();
        
        \DB::table('weight_tiers')->insert(array (
            0 => 
            array (
                'id' => 7,
                'min_weight' => '1.00',
                'max_weight' => '5.00',
                'multiplier' => 1,
                'base_service_fee' => '100.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 21:19:58',
                'deleted_at' => '2026-03-19 21:19:58',
            ),
            1 => 
            array (
                'id' => 8,
                'min_weight' => '5.01',
                'max_weight' => '10.00',
                'multiplier' => 2,
                'base_service_fee' => '100.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 21:20:04',
                'deleted_at' => '2026-03-19 21:20:04',
            ),
            2 => 
            array (
                'id' => 9,
                'min_weight' => '10.01',
                'max_weight' => '20.00',
                'multiplier' => 3,
                'base_service_fee' => '100.00',
                'price_per_kg' => '85.00',
                'platform_percentage' => '22.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-04 13:34:21',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'min_weight' => '20.01',
                'max_weight' => '30.00',
                'multiplier' => 4,
                'base_service_fee' => '100.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:49:58',
                'deleted_at' => '2026-03-20 19:49:58',
            ),
            4 => 
            array (
                'id' => 11,
                'min_weight' => '30.01',
                'max_weight' => '40.00',
                'multiplier' => 5,
                'base_service_fee' => '100.00',
                'price_per_kg' => '80.00',
                'platform_percentage' => '22.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-04 13:34:35',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'min_weight' => '40.01',
                'max_weight' => '50.00',
                'multiplier' => 6,
                'base_service_fee' => '100.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:50:27',
                'deleted_at' => '2026-03-20 19:50:27',
            ),
            6 => 
            array (
                'id' => 13,
                'min_weight' => '1.00',
                'max_weight' => '5.00',
                'multiplier' => 1,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 20:49:36',
                'deleted_at' => '2026-03-19 20:49:36',
            ),
            7 => 
            array (
                'id' => 14,
                'min_weight' => '5.01',
                'max_weight' => '10.00',
                'multiplier' => 2,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 21:20:12',
                'deleted_at' => '2026-03-19 21:20:12',
            ),
            8 => 
            array (
                'id' => 15,
                'min_weight' => '10.01',
                'max_weight' => '20.00',
                'multiplier' => 3,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:49:34',
                'deleted_at' => '2026-03-20 19:49:34',
            ),
            9 => 
            array (
                'id' => 16,
                'min_weight' => '20.01',
                'max_weight' => '30.00',
                'multiplier' => 4,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:49:47',
                'deleted_at' => '2026-03-20 19:49:47',
            ),
            10 => 
            array (
                'id' => 17,
                'min_weight' => '30.01',
                'max_weight' => '40.00',
                'multiplier' => 5,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:50:05',
                'deleted_at' => '2026-03-20 19:50:05',
            ),
            11 => 
            array (
                'id' => 18,
                'min_weight' => '40.01',
                'max_weight' => '50.00',
                'multiplier' => 6,
                'base_service_fee' => '150.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-LAGOS',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:50:20',
                'deleted_at' => '2026-03-20 19:50:20',
            ),
            12 => 
            array (
                'id' => 19,
                'min_weight' => '1.00',
                'max_weight' => '5.00',
                'multiplier' => 1,
                'base_service_fee' => '120.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '22.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-04 13:34:13',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 20,
                'min_weight' => '5.01',
                'max_weight' => '10.00',
                'multiplier' => 2,
                'base_service_fee' => '120.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-19 21:20:19',
                'deleted_at' => '2026-03-19 21:20:19',
            ),
            14 => 
            array (
                'id' => 21,
                'min_weight' => '10.01',
                'max_weight' => '20.00',
                'multiplier' => 3,
                'base_service_fee' => '120.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:49:40',
                'deleted_at' => '2026-03-20 19:49:40',
            ),
            15 => 
            array (
                'id' => 22,
                'min_weight' => '20.01',
                'max_weight' => '30.00',
                'multiplier' => 4,
                'base_service_fee' => '120.00',
                'price_per_kg' => '82.00',
                'platform_percentage' => '22.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-04 13:34:28',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'min_weight' => '30.01',
                'max_weight' => '40.00',
                'multiplier' => 5,
                'base_service_fee' => '120.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-ABUJA',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-03-20 19:50:11',
                'deleted_at' => '2026-03-20 19:50:11',
            ),
            17 => 
            array (
                'id' => 24,
                'min_weight' => '40.01',
                'max_weight' => '50.00',
                'multiplier' => 6,
                'base_service_fee' => '120.00',
                'price_per_kg' => '75.00',
                'platform_percentage' => '22.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-04 13:34:42',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'min_weight' => '0.00',
                'max_weight' => '9999.00',
                'multiplier' => 1,
                'base_service_fee' => '0.00',
                'price_per_kg' => '90.00',
                'platform_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'is_active' => 1,
                'created_at' => '2026-03-19 20:35:06',
                'updated_at' => '2026-03-19 20:35:26',
                'deleted_at' => '2026-03-19 20:35:26',
            ),
        ));
        
        
    }
}