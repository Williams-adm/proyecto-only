<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => strtolower('Administrador')
        ]);
        Role::create([
            'name' => strtolower('Vendedor')
        ]);
        Role::create([
            'name' => strtolower('Cajero')
        ]);
        Role::create([
            'name' => strtolower('Almacenero')
        ]);
    }
}
