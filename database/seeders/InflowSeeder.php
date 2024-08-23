<?php

namespace Database\Seeders;

use App\Models\DetailInflow;
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
    protected static $supplier_id = [];
    public function run(): void
    {

        $operation = strtolower('Compra de productos');
        $numVoucher = ['132987' , '7613822'];
        self::$supplier_id = [1, 2];

        foreach($numVoucher as $numVouchers){
            $supplier_id = array_shift(self::$supplier_id);
            $voucherName = 'InflowVoucher/' . Str::slug($operation . '-' . $numVouchers) . '.pdf';

            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $dompdf = new Dompdf($options);
            $content = "<h1>Número de Voucher: " . $numVouchers . "</h1><p>Operación: " . $operation . "</p><p>" .
            "Aqui va los detalles de la compra del voucher" . "</p>";
            $dompdf->loadHtml($content);
            $dompdf->render();
            $output = $dompdf->output();

            Storage::put('public/' . $voucherName, $output);
    
            $inflows = Inflow::create([
                'operation' => $operation,
                /* 'entry_date' => Carbon::now(), */
                'num_voucher' => $numVouchers,
                'path_voucher' => $voucherName,
                'supplier_id' => $supplier_id
            ]);
        }

        DetailInflow::factory(20)->create();
        
        $det1 = DetailInflow::all()->where('inflow_id', '=', 1);
        $total = $det1->sum(function ($detail){
            return $detail->quantity * $detail->purcharse_price;
        });

        $det2 = DetailInflow::all()->where('inflow_id', '=', 2);
        $total2 = $det2->sum(function ($detail2) {
            return $detail2->quantity * $detail2->purcharse_price;
        });

        if(Inflow::where('supplier_id', '=', 1)){
            $inflows->update(['total' => $total]);
        }else{
            $inflows->update(['total' => $total2]);
        }
    }
}
