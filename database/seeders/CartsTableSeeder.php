<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carts')->delete();
        
        \DB::table('carts')->insert(array (
            0 => 
            array (
                'id' => 87,
                'user_id' => 25,
                'session_id' => NULL,
                'product_id' => 406,
                'product_variant_id' => 12,
                'quantity' => 1,
                'price_at_addition' => '93600.00',
                'product_snapshot' => '{"id":406,"name":"Mama Gold Rice - 25kg","base_name":"Rice","display_name":"Mama Gold Rice - 25kg","variant_label":"Mama Gold Rice - 25kg","cost":93600,"original_cost":0,"price":93600,"customer_price":93600,"vendor_price":90000,"weight_kg":25,"category_id":31,"product_for":"both","image":"https:\\/\\/ik.imagekit.io\\/hjhce3bcsi\\/products\\/variant_1774110505_2_pQQjvsnu2","other_images":[],"unit":{"id":1,"name":"Kilogram","short_name":"kg","quantity_in_pack":1,"created_at":"2025-11-09T13:32:33.000000Z","updated_at":"2025-11-09T13:32:33.000000Z","deleted_at":null},"uom":"Kilogram","vendor_id":19,"vendor_name":"chopeasy","vendor_latitude":null,"vendor_longitude":null,"vendor":{"id":19,"fullname":"chop","username":null,"email":"chopeasy@gmail.com","phoneno":"0000000000","address":"no 2 ola aina","lga":null,"state":null,"country":null,"store_name":"chopeasy","store_image":"https:\\/\\/ik.imagekit.io\\/hjhce3bcsi\\/blogs\\/vendor_store_19_1758345950_jf5iYyN7T","latitude":null,"longitude":null},"vendor_product_item_id":93,"selected_variant_id":12,"quantity":3,"stock_status":"low_stock","stock_label":"Low stock","is_low_stock":true,"is_out_of_stock":false,"product_variant_id":12}',
                'variant_snapshot' => '{"id":12,"product_id":406,"name":"Mama Gold Rice - 25kg","cost":0,"weight":25,"brand_id":2,"quantity":0,"sku":"260402044532331499","ean":null,"unit":"1 kg","image":"https:\\/\\/ik.imagekit.io\\/hjhce3bcsi\\/products\\/variant_1774110505_2_pQQjvsnu2"}',
                'created_at' => '2026-04-13 04:07:07',
                'updated_at' => '2026-04-17 13:00:50',
                'total_cost' => '93600.00',
            ),
        ));
        
        
    }
}