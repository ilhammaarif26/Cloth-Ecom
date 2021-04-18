<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id' => 1, 'name' => 'zara', 'status' => 1],
            ['id' => 2, 'name' => 'pull and bear', 'status' => 1],
            ['id' => 3, 'name' => 'HnM', 'status' => 1]
        ];

        Brand::insert($brandRecords);
    }
}