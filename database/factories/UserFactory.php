<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static $employeeIds = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employees = Employee::doesntHave('user')->orderBy('id')->pluck('id');

        if ($employees->isEmpty()) {
            throw new \Exception('No hay empleados disponibles para asociar con un usuario');
        }

        if (empty(self::$employeeIds)) {
            self::$employeeIds = $employees->toArray();
        }

        $employeeId = array_shift(self::$employeeIds);

        $employee = Employee::find($employeeId);
        $numAletory = $this->faker->unique()->randomNumber(2, true);
        $email = Str::slug($employee->name . '-' . $employee->paternal_surname) . $numAletory . '@onlyhome.com';

        return [
            'email' => $email,
            'password' => Hash::make($this->faker->password()),
            'employee_id' => $employeeId,
        ];
    }
}
