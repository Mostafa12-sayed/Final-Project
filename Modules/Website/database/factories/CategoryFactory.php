<?php

namespace Modules\Website\database\factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Website\app\Models\Category;

class CategoryFactory extends Factory
{
    // /**
    //  * The name of the factory's corresponding model.
    //  */
    // protected $model = \Modules\Website\app\Models\Category::class;

    // /**
    //  * Define the model's default state.
    //  */
    // public function definition(): array
    // {
    //     return [];
    // }
    protected $model = Category::class;

    public function definition()
    {
        // $name = $this->faker->unique()->words(2, true);
        $categories = [
            'Healthcare',
            'Beauty Care',
            'Sexual Wellness',
            'Fitness',
            'Lab Test',
            'Baby & Mom Care',
            'Vitamins & Supplement',
            'Food & Nutrition',
            'Medical Equipments',
            'Medical Supplies',
            'Pet Care',
        ];

        $categoryDescriptions = [
            'Products and equipment aimed at supporting overall health and managing medical conditions.',
            'A range of personal care items focused on skincare, haircare, and overall aesthetic wellness.',
            'Products that promote safe, healthy, and enjoyable intimate experiences.',
            'Equipment and supplements to support physical activity, strength, and endurance.',
            'Services and kits that enable medical testing either at home or in laboratories.',
            'Essential products for newborns, infants, and new mothers for care and nourishment.',
            'Dietary supplements and vitamins that support nutritional and immune health.',
            'Healthy food items, dietary plans, and nutrition-focused products.',
            'Devices used for diagnosis, monitoring, and treatment of medical conditions.',
            'Consumable items used in clinical and home healthcare settings.',
            'Health and wellness products for the care of pets including food, hygiene, and accessories.',
        ];
        shuffle($categories);
        shuffle($categoryDescriptions);
        return [
            'name' => array_pop($categories),
            'slug' => Str::slug(array_pop($categories)),
            'parent_id' => null, // Can be overridden for subcategories
            'description' =>array_pop( $categoryDescriptions),
            'image' =>$this->faker->randomElement([
                'assets/img/icon/health-care.svg',   
                'assets/img/icon/beauty-care.svg',      
                'assets/img/icon/sexual.svg',            
                'assets/img/icon/fitness.svg',            
                'assets/img/icon/lab-test.svg',           
                'assets/img/icon/baby-mom-care.svg',      
                'assets/img/icon/supplements.svg',         
                'assets/img/icon/food-nutrition.svg',      
                'assets/img/icon/medical-equipements.svg', 
                'assets/img/icon/medical-supplies.svg',    
                'assets/img/icon/pet-care.svg',  
            ]),
            'code' => $this->faker->unique()->randomNumber(6),
            'status' => $this->faker->randomElement(['active', 'nactive']),
            'code' => Str::random(10),
        ];
    }

    // State for subcategories
    public function subcategory($parentId)
    {
        return $this->state(function (array $attributes) use ($parentId) {
            return [
                'parent_id' => $parentId,
            ];
        });
    }
}

