<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        $paternal_surname = $this->faker->word();
        $maternal_surname = $this->faker->word();
        $payment_dates = ['Fin de mes', 'Quincenal', 'Semanal'];

        $client = new Client();
        $imageUrl = 'https://picsum.photos/400/200';
        $imageName = 'employee/' . Str::slug($name . '-' . $paternal_surname . '-' . $maternal_surname) . '.jpg';

        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        return [
            'name' => ucwords($name),
            'paternal_surname' => ucwords($paternal_surname),
            'maternal_surname' => ucwords($maternal_surname), 
            'date_of_brith' => $this->faker->date(),
            'salary' => $this->faker->randomFloat(2, 500, 1500),
            'payment_date' => $this->faker->randomElement($payment_dates),
            'photo_path' => $imageName
        ];
    }
}
