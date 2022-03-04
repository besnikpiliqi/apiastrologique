<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Whatsma\ZodiacSign;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SignAstrologiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $calculator = new ZodiacSign\Calculator();
        $user = \App\Models\User::inRandomOrder()->first();
        $monthUser = (int) \Carbon\Carbon::parse($user->birthday)->format('m');
        $dayUser = (int) \Carbon\Carbon::parse($user->birthday)->format('d');

        return [
            'user_id'=> $user->id,
            'zodiac_sign' => $calculator->calculate( $dayUser, $monthUser),
        ];
    }
}
