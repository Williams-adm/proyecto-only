<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sale = Sale::all()->pluck('id')->toArray();
        $typeVoucher = strtoupper('Boleta');
        foreach($sale as $sales){
            $numVoucher = "B000" . $sales;

            $voucherName = 'VoucherSale/' . Str::slug($typeVoucher . '-' . $numVoucher) . '.pdf';
            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $dompdf = new Dompdf($options);
            $content = "<h1>Número de Voucher: " . $numVoucher . "</h1><p>Tipo Voucher: " . $typeVoucher . "</p><p>" .
            "Aqui va el voucher de venta como tal
            " . "</p>";
            $dompdf->loadHtml($content);
            $dompdf->render();
            $output = $dompdf->output();
    
            Storage::put('public/' . $voucherName, $output);

            Voucher::create([
                'type_voucher' => $typeVoucher,
                'num_voucher' => $numVoucher,
                'path' => $voucherName,
                'sale_id' => $sales
            ]);
        }
    }
}
