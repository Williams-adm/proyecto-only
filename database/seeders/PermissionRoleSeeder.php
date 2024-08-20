<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
                'role_id' => 1,
                'permission_id' => $permissions,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        DB::table('permission_role')->insert([
            'role_id' => 2,
            'permission_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('permission_role')->insert([
            'role_id' => 3,
            'permission_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('permission_role')->insert([
            'role_id' => 3,
            'permission_id' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('permission_role')->insert([
            'role_id' => 3,
            'permission_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('permission_role')->insert([
            'role_id' => 4,
            'permission_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('permission_role')->insert([
            'role_id' => 4,
            'permission_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


    }
}
