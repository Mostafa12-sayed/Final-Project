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
        // $name = $this->faker->randomElement([
        //     'Electronics',
        //     'Fashion',
        //     'Home & Garden',
        //     'Sports & Outdoors',
        //     'Health & Beauty',
        //     'Toys & Hobbies',
        //     'Automotive',
        //     'Books & Stationery',
        //     'Computers & Networking',
        //     'Jewelry & Watches',
        // ]);
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'parent_id' => null, // Can be overridden for subcategories
            'description' => $this->faker->sentence,
            'image' => $this->faker->randomElement([
                'assets/img/icon/account.svg',
                'assets/img/icon/award.svg',
                'assets/img/icon/baby-mom-care.svg',
                'assets/img/icon/sale.svg',
                'assets/img/icon/rate.svg',
                'assets/img/icon/supplements.svg',
            ]),
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

