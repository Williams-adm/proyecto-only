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
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request){
        /* añadiendo filtro a la ruta */
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);

        $perPage = $request->get('per_page', 15);

        $employees = Employee::with('user'/* , 'roles' */)
            ->where($queryItems)
            ->paginate($perPage)
            ->appends($request->query());
        return new EmployeeCollection($employees);
    }

    public function store(StoreEmployeeRequest $request){
        DB::beginTransaction();
        try{
            $name = $request->input('name');
            $paternal_surname = $request->input('paternal_surname');
            $maternal_surname = $request->input('maternal_surname');

            $photo_path = null;
            if($request->hasFile('photo_path')){
                $extension = $request->file('photo_path')->getClientOriginalExtension();
                $photoName = Str::slug($name . '-' . $paternal_surname . '-' . $maternal_surname). '.' . $extension;
                $photo_path = $request->file('photo_path')->storeAs('Employee', $photoName, 'public');
            }else{
                $photo_path = 'img/employee-without-photo.png';
            }

            $employee = Employee::create([
                'name' => $name,
                'paternal_surname' => $paternal_surname,
                'maternal_surname' => $maternal_surname,
                'date_of_birth' => $request->input('date_of_birth'),
                'salary' => $request->input('salary'),
                'payment_date' => $request->input('payment_date'),
                'photo_path' => $photo_path
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

            foreach ($request->file('employee_documents', []) as $documentFile) {
                // Obtener el tipo de documento desde el request
                $documentType = $documentFile->getClientOriginalName(); // Asumiendo que tienes un campo que lo identifica

                // Generar el nombre del archivo con el formato tipodocumento-nombres.extensión
                $fileName = Str::slug($documentType . '-' . $name . '-' . $paternal_surname . '-' . $maternal_surname) . '.' . $documentFile->getClientOriginalExtension();

                // Guardar el archivo en la subcarpeta 'EmployeeDocuments'
                $filePath = $documentFile->storeAs('EmployeeDocuments', $fileName, 'public');

                // Guardar la información del documento junto con el path
                $employee->employeeDocuments()->create([
                    'document_type' => $documentType, // Asumiendo que tienes un campo 'document_type'
                    'file_path' => $filePath,
                ]);
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
                    $document = DocumentType::where('id', $documentTypeData['id'])
                    ->where('documentable_id', $employee->id)
                    ->where('documentable_type', Employee::class)
                    ->first();
                    if($document){
                        $document->update($documentTypeData);
                    } else {
                        return response()->json(['error' => 'El tipo documento no está relacionado con este empleado.'], 403);
                    }
                }
            }
        }

        if ($request->has('phones')) {
            foreach ($request->phones as $phoneData) {
                if (isset($phoneData['id'])) {
                    $phone = Phone::where('id', $phoneData['id'])
                    ->where('phoneable_id', $employee->id)
                    ->where('phoneable_type', Employee::class)
                    ->first();
                    if ($phone) {
                        $phone->update($phoneData);
                    } else {
                        return response()->json(['error' => 'El telefono no está relacionado con este empleado.'], 403);
                    }
                }
            }
        }

        if($request->has('addresses')){
            foreach($request->addresses as $addressData){
                if(isset($addressData['id'])){
                    $address = Address::where('id', $addressData['id'])
                    ->where('addressable_id', $employee->id)
                    ->where('addressable_type', Employee::class)
                    ->first();
                    if($address){
                        $address->update($addressData);
                    } else {
                        return response()->json(['error' => 'La direccion no está relacionado con este empleado.'], 403);
                    }
                }
            }
        }

        if ($request->has('user')) {
            $userData = $request->input('user');
            $user = $employee->user;
            if ($user) {
                if(isset($userData['password'])){
                    $userData['password'] = Hash::make($userData['password']);
                }
                $user->update($userData);
            }
        }

        if($request->has('employee_documents')){
            foreach($request->employee_documents as $employeeDocData){
                if(isset($employeeDocData['id'])){
                    $employeeDocs = EmployeeDocument::where('id', $employeeDocData['id'])
                    ->where('employee_id', $employee->id)
                    ->first();
                    if($employeeDocs){
                        $employeeDocs->update($employeeDocData);
                    } else {
                        return response()->json(['error' => 'El documento no está relacionado con este empleado.'], 403);
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
