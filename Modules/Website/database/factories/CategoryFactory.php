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
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'parent_id' => null, // Can be overridden for subcategories
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(200, 200, 'categories', true),
            'status' => $this->faker->randomElement(['active', 'nactive']),
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

