<?php

namespace Database\Factories;

use App\Models\Product;
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
    protected static $productID = [];

    public function definition(): array
    {
        $product = Product::all()->pluck('id')->toArray();
        if (empty(self::$productID)) {
            self::$productID = $product;
        }
        $productID = array_shift(self::$productID);

        return [
            'stock_min' => $this->faker->numberBetween(2, 4),
            'stock_max' => $this->faker->numberBetween(20, 22),
            'current_stock' => $this->faker->numberBetween(5, 19),
            'selling_price' => $this->faker->randomFloat(2, 20, 500),
            'product_id' => $productID
        ];
    }
}
