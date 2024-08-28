<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sale = Sale::all()->pluck('id')->toArray();
        foreach($sale as $sales){
            Voucher::create([
                'type_voucher' => strtoupper('Boleta'),
                'num_voucher' => "B000" . $sales,
                'path' => "",
                'sale_id' => $sales
            ]);
        }
    }
}
