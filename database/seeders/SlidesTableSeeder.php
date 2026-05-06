<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('slides')->delete();
        
        \DB::table('slides')->insert(array (
            0 => 
            array (
                'id' => 8,
                'title' => NULL,
                'description' => NULL,
                'url' => NULL,
                'image_path' => 'https://ik.imagekit.io/hjhce3bcsi/blogs/slide_1776527463_unnamed_0swNjweHd',
                'type' => 'customer',
                'order' => 0,
                'is_active' => 1,
                'created_at' => '2026-04-18 15:51:08',
                'updated_at' => '2026-04-18 15:51:08',
            ),
            1 => 
            array (
                'id' => 9,
                'title' => NULL,
                'description' => NULL,
                'url' => NULL,
                'image_path' => 'https://ik.imagekit.io/hjhce3bcsi/blogs/slide_1776528599_unnamed_nbKHyvEbQ',
                'type' => 'customer',
                'order' => 0,
                'is_active' => 1,
                'created_at' => '2026-04-18 16:10:03',
                'updated_at' => '2026-04-18 16:10:03',
            ),
            2 => 
            array (
                'id' => 10,
                'title' => NULL,
                'description' => NULL,
                'url' => NULL,
                'image_path' => 'https://ik.imagekit.io/hjhce3bcsi/blogs/slide_1776528618_unnamed_r9mcVqX7E',
                'type' => 'customer',
                'order' => 0,
                'is_active' => 1,
                'created_at' => '2026-04-18 16:10:23',
                'updated_at' => '2026-04-18 16:10:23',
            ),
        ));
        
        
    }
}