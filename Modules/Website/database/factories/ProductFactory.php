<?php

namespace Modules\Website\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;

class ProductFactory extends Factory
{
    // /**
    //  * The name of the factory's corresponding model.
    //  */
    // protected $model = \Modules\Website\app\Models\Product::class;

    // /**
    //  * Define the model's default state.
    //  */
    // public function definition(): array
    // {
    //     return [];
    // }

    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(5, true);
        return [
            'name'        => $name,
            'description' => $this->faker->paragraph,
            'slug'        => Str::slug($name),
            'brand'       => $this->faker->randomElement(['Brand A', 'Brand B', 'Brand C']),
            'weight'      => $this->faker->randomFloat(2, 0.1, 10), // weight between 0.1 and 10
            'price'       => $this->faker->randomFloat(2, 10, 1000),
            'discount'    => $this->faker->boolean(30) ? $this->faker->randomFloat(2, 1, 100) : 0,
            'gallery'     => $this->faker->randomElements([
                'assets/img/product/01.png',
                'assets/img/product/02.png',
                'assets/img/product/03.png',
                'assets/img/product/04.png',
                'assets/img/product/05.png',
                'assets/img/product/06.png',
                'assets/img/product/07.png',
                'assets/img/product/08.png',
                'assets/img/product/09.png',
                'assets/img/product/10.png',
            ], 3, false), // 3 random images
            // 'gallery'     => json_encode($this->faker->randomElements([
            //     'assets/img/product/01.png',
            //     'assets/img/product/02.png',
            //     'assets/img/product/03.png',
            //     'assets/img/product/04.png',
            //     'assets/img/product/05.png',
            //     'assets/img/product/06.png',
            //     'assets/img/product/07.png',
            //     'assets/img/product/08.png',
            //     'assets/img/product/09.png',
            //     'assets/img/product/10.png',
            //     'assets/img/product/11.png',
            //     'assets/img/product/12.png',
            //     'assets/img/product/13.png',
            //     'assets/img/product/14.png',
            //     'assets/img/product/15.png',
            //     'assets/img/product/16.png',
            // ])),
            'image'       => $this->faker->randomElement([
                'assets/img/product/01.png',
                'assets/img/product/02.png',
                'assets/img/product/03.png',
                'assets/img/product/04.png',
                'assets/img/product/05.png',
                'assets/img/product/06.png',
                'assets/img/product/07.png',
                'assets/img/product/08.png',
                'assets/img/product/09.png',
                'assets/img/product/10.png',
                'assets/img/product/11.png',
                'assets/img/product/12.png',
                'assets/img/product/13.png',
                'assets/img/product/14.png',
                'assets/img/product/15.png',
                'assets/img/product/16.png',
                'assets/img/product/17.png',
                'assets/img/product/18.png',
                'assets/img/product/19.png',
                'assets/img/product/20.png',
                'assets/img/product/21.png',
                'assets/img/product/22.png',
                'assets/img/product/23.png',
                'assets/img/product/24.png',
                'assets/img/product/25.png',
                'assets/img/product/26.png',
                'assets/img/product/27.png',
                'assets/img/product/28.png',
                'assets/img/product/29.png',
                'assets/img/product/30.png',
                'assets/img/product/31.png',
                'assets/img/product/32.png',
                'assets/img/product/33.png',
                'assets/img/product/34.png',
                'assets/img/product/35.png',
                'assets/img/product/36.png',
                'assets/img/product/37.png',
            ]),
            'code'        => strtoupper($this->faker->bothify('??###')),
            'tax'         => $this->faker->randomFloat(2, 0, 0.3), // e.g., 0 to 30% tax
            'rating'      => $this->faker->randomFloat(1, 0, 5),    // rating between 0 and 5
            'is_new'      => $this->faker->boolean(50),
            'stock'       => $this->faker->numberBetween(0, 100),
            'quantity'    => $this->faker->numberBetween(1, 20),
            'options'     => json_encode([]), // or add some options as needed
            'status'      => $this->faker->randomElement(['active', 'draft', 'archived']),
        ];
    }
}

