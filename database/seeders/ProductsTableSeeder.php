<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecord = [
            [
                'id' => 1, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Maternal black T-shirt', 'product_code' => 'BT001',
                'product_color' => 'black', 'product_price' => 200000, 'product_discount' => '10', 'product_weight' => 200,
                'product_video' => '', 'main_image' => '', 'description' => 'Maternal t shir', 'wash_care' => '', 'fabric' => '',
                'pattren' => '',    'sleeve' => '', 'fit'  => '',   'occassion' => '', 'meta_title' => '', 'meta_description' => '',
                'meta_keywords' => '', 'is_featured' => 'no', 'status' => 1
            ],
            [
                'id' => 2, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Maternal red T-shirt', 'product_code' => 'RT001',
                'product_color' => 'red', 'product_price' => 200000, 'product_discount' => '10', 'product_weight' => 150,
                'product_video' => '', 'main_image' => '', 'description' => 'Maternal t shir', 'wash_care' => '', 'fabric' => '',
                'pattren' => '',    'sleeve' => '', 'fit'  => '',   'occassion' => '', 'meta_title' => '', 'meta_description' => '',
                'meta_keywords' => '', 'is_featured' => 'yes', 'status' => 1
            ],

        ];

        Product::insert($productRecord);
    }
}