<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $district = ['Huancayo', 'Tambo', 'Chilca', 'Pilcomayo', 'Cajas'];
        $districtrand = strtolower($this->faker->randomElement($district));
        $street = ['Ferrocarril', 'Giraldes', 'Huancavelica', 'Mariscal Castilla', 'Paseo la Breña'];
        return [
            'country' => strtolower('Peru'),
            'region' => strtolower('Junin'),
            'province' => strtolower('Huancayo'),
            'district' => $districtrand,
            'city' => $districtrand,
            'street' => strtolower('AV.') . strtolower($this->faker->randomElement($street)),
            'number' => '#' . $this->faker->randomNumber(4)
        ];
    }
}
