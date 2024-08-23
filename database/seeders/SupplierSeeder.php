<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
           'name' => strtolower('Pepito SAC'),
            'contac' => 'pepito@gmail.com'
        ]);
        Supplier::create([
           'name' => strtolower('Fantastic SAC'),
            'contac' => '+51 934980983'
        ]);
    }
}
