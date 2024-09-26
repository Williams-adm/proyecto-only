<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker-> words(2, true),
            'paternal_surname' => $this->faker->word(),
            'maternal_surname' => $this->faker->word(),
            'date_of_birth' => $this->faker->date(),
            'email' => $this->faker->safeEmail()
        ];
    }
}
