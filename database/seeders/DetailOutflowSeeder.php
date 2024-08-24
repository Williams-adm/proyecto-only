<?php

namespace Database\Seeders;

use App\Models\DetailOutflow;
use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailOutflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quantity = 1;
        DetailOutflow::create([
            'quantity' => $quantity,
            'inventory_id' => 1,
            'outflow_id' => 1
        ]);

        $stock = Inventory::find(1)->current_stock;
        $stockMod = $stock - $quantity;
        Inventory::find(1)->update(['current_stock' => $stockMod]);
    }
}
