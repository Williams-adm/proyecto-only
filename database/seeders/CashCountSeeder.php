<?php

namespace Database\Seeders;

use App\Models\CashCount;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalSale = Sale::sum('total');
        CashCount::create([
            'total_sale' => $totalSale,
            'total_income' => 0,
            'total_outflow' => 0,
            'total_cash' => $totalSale,
            'path' => "actualizar"
        ]);

        $sale = Sale::all()->pluck('id')->toArray();
        foreach($sale as $sales){
            $saleID = Sale::find($sales);
            $saleID->update([
                'cash_count_id' => 1
            ]);
        }
    }
}
