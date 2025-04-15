<?php

namespace Modules\Website\database\seeders;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;
use Modules\Website\app\Models\Stores;

class WebsiteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Create 10 categories first
    //    Category::factory()->count(11)->create();

        // Step 2: Create 100 products, assigning them to existing categories
        Product::factory()->count(100)->make()->each(function ($product) {
            $product->category_id = Category::inRandomOrder()->value('id');
            $product->save();
        });

        // Step 3: Create 10 stores
        // Stores::factory()->count(15)->create();
    }
}
