<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1, 'name' => 'admin', 'type' => 'admin', 'mobile' => '0895708400201', 'email' => 'admin@gmail.com',
                'password' => '$2y$10$/8E.bj9kSfpCky7YnKLUjO4hOeykCYK2FuKq1/cWxAloXhvuEGMZi', 'images' => '', 'status' => 1,
            ],
            [
                'id' => 12, 'name' => 'ilham', 'type' => 'admin', 'mobile' => '0895708400201', 'email' => 'ilham@gmail.com',
                'password' => '$2y$10$/8E.bj9kSfpCky7YnKLUjO4hOeykCYK2FuKq1/cWxAloXhvuEGMZi', 'images' => '', 'status' => 1,
            ],

        ];

        DB::table('admins')->insert($adminRecords);
        // foreach ($adminRecords as $key => $record) {
        //     \App\Models\Admin::create($record);
        // }
    }
}