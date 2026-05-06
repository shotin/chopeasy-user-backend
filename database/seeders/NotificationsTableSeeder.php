<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '09d06893-61f3-4845-80f4-69141b16a626',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Royal Stallion Golden Standard Rice - 10kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":90}',
                'read_at' => NULL,
                'created_at' => '2026-04-05 16:28:36',
                'updated_at' => '2026-04-05 16:28:36',
            ),
            1 => 
            array (
                'id' => '11a96d9c-ff63-46df-93ad-e56f7db25eec',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-18","message":"Order ORD-18: your vendor-price subtotal is \\u20a621,999.00. Platform take 3.00% (\\u20a6659.97). Estimated amount credited to you after confirmation: \\u20a621,339.03.","order_id":82,"order_number":"ORD-18","vendor_gross_amount":21999,"vendor_take_percent":3,"vendor_take_amount":659.97,"vendor_net_amount":21339.03}',
                'read_at' => NULL,
                'created_at' => '2026-04-25 17:12:19',
                'updated_at' => '2026-04-25 17:12:19',
            ),
            2 => 
            array (
                'id' => '12fd0e28-1e1b-4c81-b8e2-0022ec32e065',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Mama Gold Rice - 50kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":94}',
                'read_at' => NULL,
                'created_at' => '2026-04-28 09:43:31',
                'updated_at' => '2026-04-28 09:43:31',
            ),
            3 => 
            array (
                'id' => '19bc34f4-b38a-48a2-a97c-fd0ff74cdd11',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-19","message":"Order ORD-19: your vendor-price subtotal is \\u20a6154,093.00. Platform take 3.00% (\\u20a64,622.79). Estimated amount credited to you after confirmation: \\u20a6149,470.21.","order_id":83,"order_number":"ORD-19","vendor_gross_amount":154093,"vendor_take_percent":3,"vendor_take_amount":4622.79,"vendor_net_amount":149470.21}',
                'read_at' => NULL,
                'created_at' => '2026-04-28 09:43:32',
                'updated_at' => '2026-04-28 09:43:32',
            ),
            4 => 
            array (
                'id' => '20dee989-6a6d-42bd-8fd5-1279c026d3fe',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-10","message":"Order ORD-10: your vendor-price subtotal is \\u20a619,000.00. Platform take 3.00% (\\u20a6570.00). Estimated amount credited to you after confirmation: \\u20a618,430.00.","order_id":74,"order_number":"ORD-10","vendor_gross_amount":19000,"vendor_take_percent":3,"vendor_take_amount":570,"vendor_net_amount":18430}',
                'read_at' => NULL,
                'created_at' => '2026-04-05 15:31:05',
                'updated_at' => '2026-04-05 15:31:05',
            ),
            5 => 
            array (
                'id' => '28328c62-890f-4845-a96f-5cbbc1e0cd85',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":78,"vendor_codes":["QQ12XTJZ","QQ12XTJZ","QQ12XTJZ"],"pickup_location":[null,null,null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-12 20:36:00',
                'updated_at' => '2026-04-12 20:36:00',
            ),
            6 => 
            array (
                'id' => '2f53a4ac-2a42-4119-8d98-1f059e9e0fc2',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-4","message":"Order ORD-4: your vendor-price subtotal is \\u20a615,999.00. Platform take 3.00% (\\u20a6479.97). Estimated amount credited to you after confirmation: \\u20a615,519.03.","order_id":66,"order_number":"ORD-4","vendor_gross_amount":15999,"vendor_take_percent":3,"vendor_take_amount":479.97,"vendor_net_amount":15519.03}',
                'read_at' => '2026-04-05 14:07:41',
                'created_at' => '2026-04-04 14:06:25',
                'updated_at' => '2026-04-05 14:07:41',
            ),
            7 => 
            array (
                'id' => '3c067505-8c00-4a9f-a9e4-c9412b6995cb',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-9","message":"Order ORD-9: your vendor-price subtotal is \\u20a65,999.00. Platform take 3.00% (\\u20a6179.97). Estimated amount credited to you after confirmation: \\u20a65,819.03.","order_id":71,"order_number":"ORD-9","vendor_gross_amount":5999,"vendor_take_percent":3,"vendor_take_amount":179.97,"vendor_net_amount":5819.03}',
                'read_at' => '2026-04-05 14:07:41',
                'created_at' => '2026-04-05 14:06:34',
                'updated_at' => '2026-04-05 14:07:41',
            ),
            8 => 
            array (
                'id' => '44f3a81c-94c7-4b84-a2d5-a9302ddc03a5',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-17","message":"Order ORD-17: your vendor-price subtotal is \\u20a641,000.00. Platform take 3.00% (\\u20a61,230.00). Estimated amount credited to you after confirmation: \\u20a639,770.00.","order_id":81,"order_number":"ORD-17","vendor_gross_amount":41000,"vendor_take_percent":3,"vendor_take_amount":1230,"vendor_net_amount":39770}',
                'read_at' => NULL,
                'created_at' => '2026-04-18 17:40:18',
                'updated_at' => '2026-04-18 17:40:18',
            ),
            9 => 
            array (
                'id' => '4a48b37a-0ff6-4bcd-9580-cb7058e8f136',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":63,"vendor_codes":["VDDQBQCY"],"pickup_location":[null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-04 00:45:17',
                'updated_at' => '2026-04-04 00:45:17',
            ),
            10 => 
            array (
                'id' => '4b406e95-ec5e-425e-8006-b66c695146e4',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":66,"vendor_codes":["6XIT41SI","6XIT41SI"],"pickup_location":[null,null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-04 14:09:26',
                'updated_at' => '2026-04-04 14:09:26',
            ),
            11 => 
            array (
                'id' => '4d0e3b91-d120-44cd-b3cc-021f0fd856df',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":67,"vendor_codes":["HGKLQGAG","HGKLQGAG"],"pickup_location":[null,null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-04 15:25:34',
                'updated_at' => '2026-04-04 15:25:34',
            ),
            12 => 
            array (
                'id' => '56173e89-9a09-4a21-8ba0-8466194f00b6',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":83,"vendor_codes":["XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN","XQ0P7AKN"],"pickup_location":[null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-28 10:11:33',
                'updated_at' => '2026-04-28 10:11:33',
            ),
            13 => 
            array (
                'id' => '71a8b9fe-c010-4197-9d0e-96db87db16bd',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-8","message":"Order ORD-8: your vendor-price subtotal is \\u20a65,999.00. Platform take 3.00% (\\u20a6179.97). Estimated amount credited to you after confirmation: \\u20a65,819.03.","order_id":70,"order_number":"ORD-8","vendor_gross_amount":5999,"vendor_take_percent":3,"vendor_take_amount":179.97,"vendor_net_amount":5819.03}',
                'read_at' => '2026-04-05 14:07:41',
                'created_at' => '2026-04-05 14:02:24',
                'updated_at' => '2026-04-05 14:07:41',
            ),
            14 => 
            array (
                'id' => '7495fe3d-f172-4a89-a223-010f3fed21e9',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-2","message":"Order ORD-2: your vendor-price subtotal is \\u20a631,996.00. Platform take 2.00% (\\u20a6639.92). Estimated amount credited to you after confirmation: \\u20a631,356.08.","order_id":64,"order_number":"ORD-2","vendor_gross_amount":31996,"vendor_take_percent":2,"vendor_take_amount":639.92,"vendor_net_amount":31356.08}',
                'read_at' => '2026-04-04 00:22:23',
                'created_at' => '2026-04-03 20:46:48',
                'updated_at' => '2026-04-04 00:22:23',
            ),
            15 => 
            array (
                'id' => '7dab1a58-9610-424b-acba-6e2f128a39f5',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-14","message":"Order ORD-14: your vendor-price subtotal is \\u20a6106,999.00. Platform take 3.00% (\\u20a63,209.97). Estimated amount credited to you after confirmation: \\u20a6103,789.03.","order_id":78,"order_number":"ORD-14","vendor_gross_amount":106999,"vendor_take_percent":3,"vendor_take_amount":3209.97,"vendor_net_amount":103789.03}',
                'read_at' => NULL,
                'created_at' => '2026-04-12 20:35:06',
                'updated_at' => '2026-04-12 20:35:06',
            ),
            16 => 
            array (
                'id' => '84d8705f-74ff-4fb9-ba31-d09873d69bc3',
                'type' => 'App\\Notifications\\NewPickupNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 13,
                'data' => '{"order_id":64,"vendor_codes":["BJGD4XS3"],"pickup_location":[null]}',
                'read_at' => NULL,
                'created_at' => '2026-04-04 13:26:34',
                'updated_at' => '2026-04-04 13:26:34',
            ),
            17 => 
            array (
                'id' => '87dad6c6-cd67-4b82-8ea1-539ecb074efc',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-1","message":"Order ORD-1: your vendor-price subtotal is \\u20a65,999.00. Platform take 2.00% (\\u20a6119.98). Estimated amount credited to you after confirmation: \\u20a65,879.02.","order_id":63,"order_number":"ORD-1","vendor_gross_amount":5999,"vendor_take_percent":2,"vendor_take_amount":119.98,"vendor_net_amount":5879.02}',
                'read_at' => '2026-04-03 16:08:39',
                'created_at' => '2026-04-03 16:07:50',
                'updated_at' => '2026-04-03 16:08:39',
            ),
            18 => 
            array (
                'id' => 'a8ff9476-daca-4ddc-be56-4c3147be7c5b',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 20,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-19","message":"Order ORD-19: your vendor-price subtotal is \\u20a621,800.00. Platform take 3.00% (\\u20a6654.00). Estimated amount credited to you after confirmation: \\u20a621,146.00.","order_id":83,"order_number":"ORD-19","vendor_gross_amount":21800,"vendor_take_percent":3,"vendor_take_amount":654,"vendor_net_amount":21146}',
                'read_at' => '2026-04-28 10:18:02',
                'created_at' => '2026-04-28 09:43:32',
                'updated_at' => '2026-04-28 10:18:02',
            ),
            19 => 
            array (
                'id' => 'ac923003-9ce3-49f9-8857-3be09667c56a',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Cap Rice - 10kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":92}',
                'read_at' => NULL,
                'created_at' => '2026-04-12 20:35:06',
                'updated_at' => '2026-04-12 20:35:06',
            ),
            20 => 
            array (
                'id' => 'ad389987-cbf1-4ce6-96d1-58ec78d828dd',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Big Bull Rice - 50kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":96}',
                'read_at' => NULL,
                'created_at' => '2026-04-28 09:43:31',
                'updated_at' => '2026-04-28 09:43:31',
            ),
            21 => 
            array (
                'id' => 'bf922dec-c352-49b0-921d-9f5f28728624',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-15","message":"Order ORD-15: your vendor-price subtotal is \\u20a698,000.00. Platform take 3.00% (\\u20a62,940.00). Estimated amount credited to you after confirmation: \\u20a695,060.00.","order_id":79,"order_number":"ORD-15","vendor_gross_amount":98000,"vendor_take_percent":3,"vendor_take_amount":2940,"vendor_net_amount":95060}',
                'read_at' => NULL,
                'created_at' => '2026-04-17 20:13:22',
                'updated_at' => '2026-04-17 20:13:22',
            ),
            22 => 
            array (
                'id' => 'cc6c92df-e559-4a2d-81b0-80d85c1e01c9',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Irish Potato - Quarter Bag is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":99}',
                'read_at' => NULL,
                'created_at' => '2026-04-18 17:40:18',
                'updated_at' => '2026-04-18 17:40:18',
            ),
            23 => 
            array (
                'id' => 'ddd4c3cd-0d61-4a9e-a380-db8e8eaebe2d',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Big Bull Rice - 10kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":95}',
                'read_at' => NULL,
                'created_at' => '2026-04-28 09:43:31',
                'updated_at' => '2026-04-28 09:43:31',
            ),
            24 => 
            array (
                'id' => 'e205c4d2-c5d6-43ce-b1ec-f32bce614fbf',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-3","message":"Order ORD-3: your vendor-price subtotal is \\u20a699,000.00. Platform take 2.00% (\\u20a61,980.00). Estimated amount credited to you after confirmation: \\u20a697,020.00.","order_id":65,"order_number":"ORD-3","vendor_gross_amount":99000,"vendor_take_percent":2,"vendor_take_amount":1980,"vendor_net_amount":97020}',
                'read_at' => '2026-04-04 00:22:23',
                'created_at' => '2026-04-03 23:21:44',
                'updated_at' => '2026-04-04 00:22:23',
            ),
            25 => 
            array (
                'id' => 'ecad8739-9e07-4567-8d7f-45cbda4e9197',
                'type' => 'App\\Notifications\\VendorOrderPayoutNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
            'data' => '{"type":"payment","title":"New order \\u2014 ORD-5","message":"Order ORD-5: your vendor-price subtotal is \\u20a621,998.00. Platform take 3.00% (\\u20a6659.94). Estimated amount credited to you after confirmation: \\u20a621,338.06.","order_id":67,"order_number":"ORD-5","vendor_gross_amount":21998,"vendor_take_percent":3,"vendor_take_amount":659.94,"vendor_net_amount":21338.06}',
                'read_at' => '2026-04-05 14:07:41',
                'created_at' => '2026-04-04 15:22:44',
                'updated_at' => '2026-04-05 14:07:41',
            ),
            26 => 
            array (
                'id' => 'efec6ea1-c88b-4656-8c41-acff15fb0c02',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Cap Rice - 5kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":91}',
                'read_at' => NULL,
                'created_at' => '2026-04-12 20:35:06',
                'updated_at' => '2026-04-12 20:35:06',
            ),
            27 => 
            array (
                'id' => 'f4ee77cd-05ca-4650-a8f8-ecc5d95f48ee',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Royal Stallion Golden Standard Rice - 5kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":89}',
                'read_at' => '2026-04-05 14:07:41',
                'created_at' => '2026-04-05 13:38:06',
                'updated_at' => '2026-04-05 14:07:41',
            ),
            28 => 
            array (
                'id' => 'fcefbc20-c976-4e0d-8ca5-4ca5c67794c8',
                'type' => 'App\\Notifications\\VendorProductOutOfStockNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 19,
                'data' => '{"type":"inventory","title":"Product out of stock","message":"Irish Potatoes 1 kg is now out of stock. Restock in your inventory so customers can order again.","vendor_product_item_id":98}',
                'read_at' => NULL,
                'created_at' => '2026-04-18 17:40:18',
                'updated_at' => '2026-04-18 17:40:18',
            ),
        ));
        
        
    }
}