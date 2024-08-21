<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* $NumRandom = ['51' , '52' , '54']; */
        return [
            'prefix' => '+51', /* . $this->faker->randomElement($NumRandom), */
            'number' => $this->faker->unique()->randomNumber(9, false)
        ];
    }
}
