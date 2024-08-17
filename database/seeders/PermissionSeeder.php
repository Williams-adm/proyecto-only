<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => strtolower('Clientes')
        ]);
        Permission::create([
            'name' => strtolower('Empleados')
        ]);
        Permission::create([
            'name' => strtolower('Ventas')
        ]);
        Permission::create([
            'name' => strtolower('Caja')
        ]);
        Permission::create([
            'name' => strtolower('Inventario')
        ]);
        Permission::create([
            'name' => strtolower('Codificar')
        ]);
        Permission::create([
            'name' => strtolower('Graficos')
        ]);
        Permission::create([
            'name' => strtolower('Comprobantes')
        ]);
        Permission::create([
            'name' => strtolower('Reportes')
        ]);

    }
}
