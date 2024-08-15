<?php

namespace Database\Seeders;

use App\Models\TypeRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeRecord::create([
            'type' => strtoupper('manual'),
            'customer_id' => 1,
        ]);
        TypeRecord::create([
            'type' => strtoupper('manual'),
            'customer_id' => 2,
        ]);
        
        TypeRecord::factory(13)->create(); 
    }
}
