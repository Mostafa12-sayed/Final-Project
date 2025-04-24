<?php

namespace Modules\Website\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HeroSectionyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Website\app\Models\HeroSections::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {

        return [
            'title' => 'Medicine & Health Care For Your Family in city',
            'patch' => 'Easy Health Care',
            'description' => 'There are many variations of passages orem psum available but the majority
                                    have suffered alteration in some form by injected humour.',
            'image' => $this->faker->randomElement([
                'assets/img/hero/slider-1.jpg',
                'assets/img/hero/slider-2.jpg',
                'assets/img/hero/slider-3.jpg',
            ]),
        ];
    }
}
