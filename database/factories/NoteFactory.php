<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = ['2024-12-24', '2024-12-20', '2024-12-15', '2024-12-08'];
        return [
            'note_text' => $this->faker->text(250),
            'reminder_date' => $this->faker->randomElement($date)
        ];
    }
}
