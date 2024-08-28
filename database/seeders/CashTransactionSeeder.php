<?php

namespace Database\Seeders;

use App\Models\CashCount;
use App\Models\CashTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CashTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amountSalida = 190.00;
        $amountEntrada = 50.00;
        CashTransaction::create([
            'amount' => $amountSalida,
            'type' => strtoupper("salida"),
            'description' => "Almuerzo empleados",
            'cash_count_id' => 1
        ]);
        CashTransaction::create([
            'amount' => $amountEntrada,
            'type' => strtoupper("entrada"),
            'description' => "Diseño extra",
            'cash_count_id' => 1
        ]);

        $cashCount = CashCount::find(1);
        $cashCount->update([
            'total_income' => $amountEntrada,
            'total_outflow'=> $amountSalida
        ]);

        $cashCountName = 'CashCount/' . Str::slug("arqueo-caja" . '-' . $cashCount->id) . '.pdf';
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        $cashtotal = $cashCount->total_sale - $cashCount->total_outflow + $cashCount->total_income;
        $content = "<h1>Arqueo de caja: N°" . $cashCount->id . "</h1>
        <p>Total de vetas: $ " . $cashCount->total_sale . "</p>
        <p>Total de salidas: $ " . $cashCount->total_outflow . "</p>
        <p>Total de entradas: $ " . $cashCount->total_income . "</p>
        <p>Total de entradas: $ " . $cashtotal . "</p>";
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        Storage::put('public/' . $cashCountName, $output);

        $cashCount->update([
            'path' => $cashCountName,
        ]); 
    }
}