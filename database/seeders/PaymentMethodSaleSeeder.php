<?php

namespace Database\Seeders;

use App\Models\PaymentMethodSale;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sale = Sale::all()->pluck('id')->toArray();
        foreach ($sale as $sales){
            PaymentMethodSale::create([
                'quantity' => Sale::find($sales)->total,
                'sale_id' => $sales,
                'payment_method_id' => $sales
            ]);

        }
    }
}
