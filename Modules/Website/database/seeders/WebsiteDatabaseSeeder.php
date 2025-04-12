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
//        Category::factory()->count(11)->create();

        // Step 2: Create 100 products, assigning them to existing categories
        Product::factory()->count(100)->create([
            'category_id' => function () {
                // Randomly pick an existing category
                return Category::inRandomOrder()->first()->id;
            },
        ]);
    }
}
