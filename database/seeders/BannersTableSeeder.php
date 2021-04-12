<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecord = [
            [
                'id' => 1, 'image' => 'banner1.jpeg', 'link' => '', 'title' => 'black T Shirt', 'alt' => 'black tshirt',
                'status' => 1
            ],
            [
                'id' => 2, 'image' => 'banner2.jpeg', 'link' => '', 'title' => 'white T Shirt', 'alt' => 'white tshirt',
                'status' => 1
            ]
        ];

        Banner::insert($bannerRecord);
    }
}