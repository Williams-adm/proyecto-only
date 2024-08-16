<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        if($employee && $role){
            $employee->roles()->attach($role->id);
        }

        $rolesToAssign = $role->where('id', '!=', $role->id)->pluck('id')->toArray();
        $employeesToAssign = $employees->where('id', '!=', $specificEmployeeId)->pluck('id')->toArray();

        foreach($employeesToAssign as $employeeAsig){
            $employeeAsig->roles()->sync($rolesToAssign->pluck('id'));
        }
    }
}
