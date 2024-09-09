<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);

        $employees = Employee::where($queryItems);
        return new EmployeeCollection($employees->paginate()->appends($request->query()));
    }

    public function store(){
        
    }
}
