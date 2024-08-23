<?php

namespace Database\Factories;

use App\Models\Inflow;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailInflow>
 */
class DetailInflowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $inventoryID = [];
    public function definition(): array
    {
        $profit = $this->faker->randomFloat(2, 0, 0.40);
        $inflow_id = Inflow::all()->pluck('id');

        $inventory = Inventory::all()->pluck('id')->toArray();
        if (empty(self::$inventoryID)) {
            self::$inventoryID = $inventory;
        }
        $inventoryID = array_shift(self::$inventoryID);
        $searchInventory = Inventory::find($inventoryID);
        $pucharsePriceSinIGV = ($searchInventory->selling_price) / 1.18;
        $pucharsePrice = $pucharsePriceSinIGV / (1+$profit);

        return [
            'quantity' => $searchInventory->current_stock,
            'purcharse_price' => $pucharsePrice,
            'profit' => $profit,
            'inflow_id' => $this->faker->randomElement($inflow_id),
            'inventory_id' => $inventoryID
        ];
    }
}
