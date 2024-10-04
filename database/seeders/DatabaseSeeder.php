<?php

namespace Database\Seeders;

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
        $this->call(CustomerSeeder::class);
        $this->call(TypeRecordSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EmployeeRoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DetailSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(DiscountInventorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(InflowSeeder::class);
        $this->call(OutflowSeeder::class);
        $this->call(DetailOutflowSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(DetailSaleSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PaymentMethodSaleSeeder::class);
        $this->call(CashCountSeeder::class);
        $this->call(CashTransactionSeeder::class);
        $this->call(VoucherSeeder::class);
    }
}
