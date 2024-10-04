<?php

namespace Database\Seeders;

use App\Models\DetailImage;
use App\Models\DetailValue;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(20)->create();
        DetailValue::factory(20)->create();
        DetailImage::factory(20)->create();
        Inventory::factory(20)->create();
    }
}
