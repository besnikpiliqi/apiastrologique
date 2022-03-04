<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'postcode' => $this->faker->randomNumber($nbDigits = 5, $strict = true),
            'street_number' => $this->faker->randomNumber($nbDigits = 3),
            'street_name' => $this->faker->streetName(),
            'coord_lat' => $this->faker->latitude(),
            'coord_lon' => $this->faker->longitude(),
            'timezone' => $this->faker->timezone(),
        ];
    }
}
