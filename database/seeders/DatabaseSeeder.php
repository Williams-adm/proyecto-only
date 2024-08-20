<?php

namespace Database\Seeders;

use App\Models\EmployeeDocument;
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
    }
}
