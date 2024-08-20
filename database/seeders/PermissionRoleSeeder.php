<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::all()->pluck('id')->toArray();
        foreach ($permission as $permissions){
            DB::table('permission_role')->insert([
                'rol_id'
            ]);
        }
    }
}
