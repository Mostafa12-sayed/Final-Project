<?php

namespace database\factories;

use app\Models\SiteInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SiteInfo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'site_name' => 'Medion',
            'email' => "medion@gmail.com",
            'phone1' => "01012345678",
            'phone2' => "0123456789",
            'address' => "Elgamaa street, Fayoum, Egypt",
            'opening_time' => '09:00 AM',
            'closing_time' => '06:00 PM',
            'logo_path' => 'public\assets\img\logo\logo.png',
            'about' => $this->faker->paragraph,
            'facebook' => 'https://facebook.com/' . $this->faker->userName,
            'twitter' => 'https://twitter.com/' . $this->faker->userName,
            'instagram' => 'https://instagram.com/' . $this->faker->userName,
        ];
    }
}

