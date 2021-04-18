<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            ['id' => 1, 'product_id' => 1, 'size' => 'small', 'price' => 200000, 'stock' => 10, 'sku' => 'EBT001-S', 'status' => 1],
            ['id' => 2, 'product_id' => 1, 'size' => 'medium', 'price' => 200000, 'stock' => 15, 'sku' => 'EBT002-M', 'status' => 1],
            ['id' => 3, 'product_id' => 1, 'size' => 'large', 'price' => 200000, 'stock' => 20, 'sku' => 'PNB001-L', 'status' => 1],
        ];

        ProductsAttribute::insert($productAttributesRecords);
    }
}