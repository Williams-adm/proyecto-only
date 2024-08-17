<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class EmployeeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $employees = Employee::all();

        $specificEmployeeId = 1;
        $specificRoleName = strtolower("Administrador");

        $employee = $employees->find($specificEmployeeId);
        $role = $roles->where('name', $specificRoleName)->first();

        DB::table('employee_role')->insert([
            'employee_id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 2,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 3,
            'role_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 4,
            'role_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 5,
            'role_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 6,
            'role_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employee_role')->insert([
            'employee_id' => 3,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
