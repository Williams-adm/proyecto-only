<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhoneResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function getPhonesByEmployee($employee)
    {
        $employeeSearch = Employee::with('phones')->findOrFail($employee);
        $phones = $employeeSearch->phones;
        return PhoneResource::collection($phones);
    }


}
