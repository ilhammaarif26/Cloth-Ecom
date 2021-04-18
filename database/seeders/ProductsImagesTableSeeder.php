<?php

namespace Database\Seeders;

use App\Models\ProductsImage;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecords = [
            [
                'id' => 1, 'product_id' => 2, 'image' => 'blacktshirt.jpeg-399540.jpeg', 'status' => 1
            ]
        ];

        ProductsImage::insert($productImageRecords);
    }
}