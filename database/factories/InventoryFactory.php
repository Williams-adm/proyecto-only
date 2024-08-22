<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_min' => $this->faker->numberBetween(2, 4),
            'stock_max' => $this->faker->numberBetween(20, 22),
            'current_stock' => $this->faker->numberBetween(5, 19),
            'selling_price' => $this->faker->decimal()
        ];
    }
}
