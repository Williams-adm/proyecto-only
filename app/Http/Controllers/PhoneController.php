<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhoneResource;
use App\Models\Customer;
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

    public function getPhonesByCustomer($customer)
    {
        $customerSearch = Customer::with('phones')->findOrFail($customer);
        $phones = $customerSearch->phones;
        return PhoneResource::collection($phones);
    }


}
