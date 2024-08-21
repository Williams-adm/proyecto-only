<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = ['color', 'material', 'dimensiones', 'peso', 'acabado'];

        foreach($type as $types){
            Detail::create([
                'type' => strtolower($types)
            ]);
        }
    }
}
