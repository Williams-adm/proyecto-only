<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request){
        /* añadiendo filtro a la ruta */
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);
        
        $employees = Employee::with('user', 'roles')->where($queryItems);
        return new EmployeeCollection($employees->paginate()->appends($request->query()));
    }

    public function store(StoreEmployeeRequest $request){
        /* return new EmployeeResource(Employee::create($request->all())); */
        DB::beginTransaction();
        try{
            $employee = Employee::create([
                'name' => $request->input('name'),
                'paternal_surname' => $request->input('paternal_surname'),
                'maternal_surname' => $request->input('maternal_surname'),
                'date_of_birth' => $request->input('date_of_birth'),
                'salary' => $request->input('salary'),
                'payment_date' => $request->input('payment_date'),
                'photo_path' => $request->input('photo_path'),
            ]);

            foreach($request->input('document_types') as $documentsData){
                $employee->documentTypes()->create($documentsData);
            }

            foreach($request->input('phones') as $phonesData){
                $employee->phones()->create($phonesData);
            }

            foreach($request->input('addresses') as $addressesData){
                $employee->addresses()->create($addressesData);
            }
            foreach($request->input('employee_documents') as $employeeDocumentsData){
                $employee->EmployeeDocuments()->create($employeeDocumentsData);
            }

            DB::commit();
            return response()->json(['message' => 'Empleado creado exitosamente'], 201);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Error al crear empleado: ' . $e->getMessage()], 500);
        }
    }

    public function show(Employee $employee){
        $employee->load('documentTypes', 'phones', 'addresses', 'user', 'employeeDocuments');
        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee){
        $employee->update($request->all());
        return response()->json(['message' => "El empleado con el id {$employee->id} ha sido actualizado"], 200); 
    }
    
    public function destroy(Employee $employee){
        $employee->delete();
        return response()->json(['message' => "El empleado con el id {$employee->id} ha sido eliminado"], 200);
    }
}
