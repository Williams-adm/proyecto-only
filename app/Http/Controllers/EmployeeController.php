<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;


class EmployeeController extends Controller
{
    public function index(Request $request){
        /* añadiendo filtro a la ruta */
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);

        $employees = Employee::with('documentTypes', 'phones', 'addresses','user', 'notes')->where($queryItems);
        return new EmployeeCollection($employees->paginate()->appends($request->query()));
    }

    public function store(StoreEmployeeRequest $request){
        return new EmployeeResource(Employee::create($request->all()));
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee){
        $employee->update($request->all());
        return "El empleado con el id $employee->id ha sido actualizado"; 
    }
    
    public function destroy(Employee $employee){
        $employee->delete();
        return "El empleado con el id $employee->id ha sido eliminado";
    }
}
