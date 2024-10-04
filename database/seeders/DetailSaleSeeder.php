<?php

namespace Database\Seeders;

use App\Models\DetailSale;
use App\Models\Discount;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventory = Inventory::all()->pluck('id')->toArray();
        $quantity = [1, 2, 3];
        $sale = [1, 2, 3];
        
        foreach($sale as $sales){ 
            $subTotal = 0;
            for ($i = 1; $i<=4; $i++){
                $inventoryKey = array_rand($inventory);
                $inventoryID = $inventory[$inventoryKey];
                unset($inventory[$inventoryKey]);
                $inventory = array_values($inventory);
    
                $inventorySearch = Inventory::find($inventoryID);
                /* $productID = $inventorySearch->product_id; */
        
                $quantityvalue = $quantity[array_rand($quantity)];
                $unitprice = $inventorySearch->selling_price;
        
        
                $discountSearch = DB::table('discount_inventory')->where('inventory_id', $inventoryID)->select('discount_id')->first();
                if($discountSearch){
                    $discountID = $discountSearch->discount_id;
                    $discount = Discount::find($discountID)->porcentage;
                }else{
                    $discount = 0.00;
                }
                
                $amount = ($quantityvalue * $unitprice) * (1-$discount);
                $subTotal += $amount; 

                DetailSale::create([
                    'quantity' => $quantityvalue,
                    'unit_price' => $unitprice,
                    'discount' => $discount,
                    'amount' => $amount,
                    'sale_id' => $sales,
                    'inventory_id' => $inventoryID 
                ]);
                $stock = $inventorySearch->current_stock;
                $inventorySearch->update(['current_stock' => $stock - $quantityvalue]);
            }
            $igv = $subTotal / 1.18;
            $total = $subTotal + $igv;
            Sale::find($sales)->update([
                'sub_total' => $subTotal,
                'igv' => $igv,
                'total' => $total
            ]);
        }
    }
}
