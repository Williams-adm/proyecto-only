<?php

namespace Database\Seeders;

use App\Models\Phone;
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
            'num_ruc' => '105854650',
            'business_name' => strtolower('Pepito SAC'),
            'fiscal_address' => strtolower('JR. Olaya #222'),
            'contac' => 'pepito@gmail.com'
        ]);
        Supplier::create([
            'num_ruc' => '208182924',
            'business_name' => strtolower('Fantastic SAC'),
            'fiscal_address' => strtolower('JR. Arequipa #942'),
            'contac' => 'fantastic@gmail.com'
        ]);

        $suppliers = Supplier::all()->pluck('id')->toArray();
        foreach($suppliers as $supplierPhones){
            Phone::factory(1)->create([
                'phoneable_id' => $supplierPhones,
                'phoneable_type' => Supplier::class
            ]);
        }
    }
}
