<?php

namespace Database\Seeders;

use App\Models\Outflow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outflow::create([
            'code' => 21313,
            'operation' => "Producto dañado",
            'reazon' => "El producto se rompio, en el trasladoñ",
            'branch_id' => 1
        ]);
    }
}
