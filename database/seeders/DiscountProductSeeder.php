<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DiscountProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::all()->pluck('id')->toArray();
        
        for($i=1; $i<=5 ; $i++){
            $productRand = array_rand($product);
            $productID = $product[$productRand];
            unset($product[$productRand]);
            $product = array_values($product);

            DB::table('discount_product')->insert([
                'product_id' => $productID,
                'discount_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        for($j=1; $j<=5 ; $j++){
            $productRand = array_rand($product);
            $productID = $product[$productRand];
            unset($product[$productRand]);
            $product = array_values($product);

            DB::table('discount_product')->insert([
                'product_id' => $productID,
                'discount_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
