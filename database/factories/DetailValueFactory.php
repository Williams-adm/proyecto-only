<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailValue>
 */
class DetailValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::all()->pluck('id')->toArray(); 
        $productID = array_shift($product);

        return [
            'value' => $this->faker->safeColorName(),
            'detail_id' => 1,
            'product_id' => $productID
        ];
    }
}
