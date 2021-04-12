<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminTableSeeder::class);
        // \App\Models\User::factory(10)->create();
        // $this->call(SectionsTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductsAttributesTableSeeder::class);
        // $this->call(ProductsImagesTableSeeder::class);
        // $this->call(BrandTableSeeder::class);
        $this->call(BannersTableSeeder::class);
    }
}