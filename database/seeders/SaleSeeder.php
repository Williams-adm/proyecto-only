<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::create([
            'code' => 'V001',
            'sub_total' => 0.0,
            'igv' => 0.0,
            'total' => 0.0,
            'customer_id' => 12,
            'employee_id'  => 1,
            'branch_id' => 1
        ]);
        Sale::create([
            'code' => 'V002',
            'sub_total' => 0.0,
            'igv' => 0.0,
            'total' => 0.0,
            'customer_id' => 5,
            'employee_id'  => 2,
            'branch_id' => 1
        ]);
        Sale::create([
            'code' => 'V003',
            'sub_total' => 0.0,
            'igv' => 0.0,
            'total' => 0.0,
            'customer_id' => 9,
            'employee_id'  => 3,
            'branch_id' => 1
        ]);
    }
}
