<?php

namespace Modules\Website\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;

class WebsiteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 products, each assigned to a random category
        // Product::factory()->count(50)->create();

        Category::factory()->count(10)->create();
        $parent = Category::first();
        Category::factory()->count(5)->subcategory($parent->id)->create();
    }
}
