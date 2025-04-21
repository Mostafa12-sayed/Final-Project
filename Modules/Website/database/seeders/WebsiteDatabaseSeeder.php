<?php

namespace Modules\Website\database\seeders;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;
use Modules\Website\app\Models\Stores;
use Illuminate\Support\Str;

class WebsiteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Healthcare',
                'description' => 'Products and equipment aimed at supporting overall health and managing medical conditions.',
                'image' => 'assets/img/icon/health-care.svg',
            ],
            [
                'name' => 'Beauty Care',
                'description' => 'A range of personal care items focused on skincare, haircare, and overall aesthetic wellness.',
                'image' => 'assets/img/icon/beauty-care.svg',
            ],
            [
                'name' => 'Sexual Wellness',
                'description' => 'Products that promote safe, healthy, and enjoyable intimate experiences.',
                'image' => 'assets/img/icon/sexual.svg',
            ],
            [
                'name' => 'Fitness',
                'description' => 'Equipment and supplements to support physical activity, strength, and endurance.',
                'image' => 'assets/img/icon/fitness.svg',
            ],
            [
                'name' => 'Lab Test',
                'description' => 'Services and kits that enable medical testing either at home or in laboratories.',
                'image' => 'assets/img/icon/lab-test.svg',
            ],
            [
                'name' => 'Baby & Mom Care',
                'description' => 'Essential products for newborns, infants, and new mothers for care and nourishment.',
                'image' => 'assets/img/icon/baby-mom-care.svg',
            ],
            [
                'name' => 'Vitamins & Supplement',
                'description' => 'Dietary supplements and vitamins that support nutritional and immune health.',
                'image' => 'assets/img/icon/supplements.svg',
            ],
            [
                'name' => 'Food & Nutrition',
                'description' => 'Healthy food items, dietary plans, and nutrition-focused products.',
                'image' => 'assets/img/icon/food-nutrition.svg',
            ],
            [
                'name' => 'Medical Equipments',
                'description' => 'Devices used for diagnosis, monitoring, and treatment of medical conditions.',
                'image' => 'assets/img/icon/medical-equipements.svg',
            ],
            [
                'name' => 'Medical Supplies',
                'description' => 'Consumable items used in clinical and home healthcare settings.',
                'image' => 'assets/img/icon/medical-supplies.svg',
            ],
            [
                'name' => 'Pet Care',
                'description' => 'Health and wellness products for the care of pets including food, hygiene, and accessories.',
                'image' => 'assets/img/icon/pet-care.svg',
            ],
        ];

        

        // Step 1: Create 10 categories first
        // Category::factory()->count(11)->create();

        // Step 2: Create 100 products, assigning them to existing categories
        // Insert categories, creating them only if they don’t exist
    foreach ($categories as $categoryData) {
        Category::firstOrCreate(
            ['name' => $categoryData['name']],
            [
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
                'code' => Str::upper(Str::random(10)),
                'status' => 'active',
                'parent_id' => null,
            ]
        );
    }

            // Create 100 products, assigning them to random existing categories
            Product::factory()->count(100)->create([
                'category_id' => function () {
                    return Category::inRandomOrder()->first()->id;
                },
            ]);


        // Step 3: Create 10 stores
        // Stores::factory()->count(15)->create();
    }
}
