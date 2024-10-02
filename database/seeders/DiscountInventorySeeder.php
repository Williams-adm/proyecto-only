<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DiscountInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventory = Inventory::all()->pluck('id')->toArray();
        
        for($i=1; $i<=5 ; $i++){
            $inventoryRand = array_rand($inventory);
            $inventoryID = $inventory[$inventoryRand];
            unset($inventory[$inventoryRand]);
            $inventory = array_values($inventory);

            DB::table('discount_product')->insert([
                'product_id' => $inventoryID,
                'discount_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        for($j=1; $j<=5 ; $j++){
            $inventoryRand = array_rand($inventory);
            $inventoryID = $inventory[$inventoryRand];
            unset($inventory[$inventoryRand]);
            $inventory = array_values($inventory);

            DB::table('discount_product')->insert([
                'product_id' => $inventoryID,
                'discount_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
