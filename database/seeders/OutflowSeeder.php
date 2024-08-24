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
            'reazon' => "Producto dañado"
        ]);
    }
}
