<?php

namespace Database\Seeders;

use App\Models\Shipp;
use Illuminate\Database\Seeder;

class ShippTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ShipRecord = [
                [
                   'id' => 1, 'address' => 'Jakarta', 'price' => 25000 , 'type' => 'regular', 'status' => 1
                ],
                [
                    'id' => 2, 'address' => 'Bandung', 'price' => 30000 , 'type' => 'regular', 'status' => 1
                ],
                [
                    'id' => 3, 'address' => 'Yogyakarta', 'price' => 35000 , 'type' => 'regular', 'status' => 1
                ],
            ];

        Shipp::insert($ShipRecord);
    }
}
