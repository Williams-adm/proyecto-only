<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Address;
use App\Models\DocumentType;
use App\Models\EmployeeDocument;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

            $employee->user()->create([
                'email' => $request->input('user.email'),
                'password' => Hash::make($request->input('user.password')),
            ]);

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

        if($request->has('document_types')){
            foreach($request->document_types as $documentTypeData){
                if(isset($documentTypeData['id'])){
                    $document = DocumentType::find($documentTypeData['id']);
                    if($document){
                        $document->update($documentTypeData);
                    }
                }
            }
        }

        if ($request->has('phones')) {
            foreach ($request->phones as $phoneData) {
                if (isset($phoneData['id'])) {
                    $phone = Phone::find($phoneData['id']);
                    if ($phone) {
                        $phone->update($phoneData);
                    }
                }
            }
        }

        if($request->has('addresses')){
            foreach($request->addresses as $addressData){
                if(isset($addressData['id'])){
                    $address = Address::find($addressData['id']);
                    if($address){
                        $address->update($addressData);
                    }
                }
            }
        }

        if ($request->has('user')) {
            $userData = $request->input('user');  // Extraer los datos del usuario del request

            // Suponiendo que el empleado tiene una relación uno a uno con User
            $user = $employee->user;

            if ($user) {
                $user->update($userData);
            }
        }

        if($request->has('employee_documents')){
            foreach($request->employee_documents as $employeeDocData){
                if(isset($employeeDocData['id'])){
                    $employeeDocs = EmployeeDocument::find($employeeDocData['id']);
                    if($employeeDocs){
                        $employeeDocs->update($employeeDocData);
                    }
                }
            }
        }

        return response()->json(['message' => "El empleado con el id {$employee->id} ha sido actualizado"], 200); 
    }
    
    public function destroy(Employee $employee){
        $employee->delete();
        return response()->json(['message' => "El empleado con el id {$employee->id} ha sido eliminado"], 200);
    }
}
