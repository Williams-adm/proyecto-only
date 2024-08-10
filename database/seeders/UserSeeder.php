<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeesid = [1];
        /* $employeesid = Employee::doesntHave('user')->orderBy('id')->pluck('id')->toArray(); */
        $NumAletory = [12, 10, 22, 44, 56];
        foreach ($employeesid as $employeeid){
            $employee = Employee::find($employeeid);
            User::create([
                'email' => strtolower($employee->name) . '-' . strtolower($employee->paternal_surname) . Arr::random($NumAletory) . '@onlyhome.com',
                'password' => Hash::make('admin12R'),
                'employee_id' => $employee->id,
            ]);
        }
        User::factory(5)->create();
    }
}
