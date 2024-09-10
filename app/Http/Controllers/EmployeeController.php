<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;


class EmployeeController extends Controller
{
    public function index(Request $request){
        /* añadiendo filtro a la ruta */
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);
        $employees = Employee::where($queryItems);
        return new EmployeeCollection($employees->paginate()->appends($request->query()));
    }

    public function store(StoreEmployeeRequest $request){
        return new EmployeeResource(Employee::create($request->all()));
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }

    public function update(){

    }
}
