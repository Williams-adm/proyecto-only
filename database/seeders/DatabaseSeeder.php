<?php

namespace Database\Seeders;

use App\Models\DetailImage;
use App\Models\DetailValue;
use App\Models\EmployeeDocument;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EmployeeSeeder::class);
        $this->call(UserSeeder::class);
        EmployeeDocument::factory(18)->create();
        $this->call(CustomerSeeder::class);
        $this->call(TypeRecordSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EmployeeRoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(CategorySeeder::class);
        Product::factory(20)->create();
        $this->call(DiscountSeeder::class);
        $this->call(DiscountProductSeeder::class);
        $this->call(DetailSeeder::class);
        DetailValue::factory(20)->create();
        DetailImage::factory(20)->create();
        Inventory::factory(20)->create();
        $this->call(SupplierSeeder::class);
        $this->call(InflowSeeder::class);
        $this->call(OutflowSeeder::class);
        $this->call(DetailOutflowSeeder::class);

        $this->call(SaleSeeder::class);
        $this->call(DetailSaleSeeder::class);
        $this->call(PaymentMethodSeeder::class);
    }
}
