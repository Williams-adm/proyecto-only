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

        $voucherName = 'VoucherSale/' . Str::slug($operation . '-' . $numVouchers) . '.pdf';
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        $content = "<h1>Número de Voucher: " . $numVouchers . "</h1><p>Tipo Voucher: " . $operation . "</p><p>" .
        "Aqui la venta como tal
        " . "</p>";
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        Storage::put('public/' . $voucherName, $output);

        foreach($sale as $sales){
            Voucher::create([
                'type_voucher' => strtoupper('Boleta'),
                'num_voucher' => "B000" . $sales,
                'path' => $voucherName,
                'sale_id' => $sales
            ]);
        }
    }
}
