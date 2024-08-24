<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $method = ['efectivo', 'Tarjeta de credito', 'Tarjeta debito', 'Transferencia bancaria', 'pago digital'];
        foreach ($method as $methods){
            PaymentMethod::create([
                'name_method' => strtolower($methods)
            ]);
        }
        
    }
}
