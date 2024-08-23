<?php

namespace Database\Seeders;

use App\Models\Inflow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
/* use Illuminate\Support\Carbon; */
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $operation = strtolower('Compra de productos');
        $numVoucher = ['132987' , '7613822'];

        foreach($numVoucher as $numVouchers){
            $supplier_id = [1, 2];
            $supplier_id = array_shift($supplier_id);
            $voucherName = 'InflowVoucher/' . Str::slug($operation . '-' . $numVouchers) . '.pdf';

            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $dompdf = new Dompdf($options);
            $content = "<h1>Número de Voucher: " . $numVouchers . "</h1><p>Operación: " . $operation . "</p><p>" .
            "Aqui va los detalles de la compra del voucher" . "</p>";
            $dompdf->loadHtml($content);
            $dompdf->render();
            $output = $dompdf->output();
            $supplier_id = 1;

            Storage::put('public/' . $voucherName, $output);
    
            Inflow::create([
                'operation' => $operation,
                /* 'entry_date' => Carbon::now(), */
                'num_voucher' => $numVouchers,
                'path_voucher' => $voucherName,
                'supplier_id' => $supplier_id
            ]);
        }
    }
}
