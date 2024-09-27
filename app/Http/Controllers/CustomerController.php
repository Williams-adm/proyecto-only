<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\CustomerFilter;
use App\Filters\CustomerBusinessFilter;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerBusinessCollection;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class CustomerController extends Controller
{
    public function index(Request $request){
        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);

        $customer = Customer::where($queryItems)
        ->doesntHave('documentTypes', 'and', function ($query){
            $query->where('type', 'RUC');
        })->with('typeRecords', 'documentTypes')->paginate()->appends($request->query());

        return new CustomerCollection($customer);
    }

    public function indexBusiness(Request $request)
    {
        $filter = new CustomerBusinessFilter();
        $queryItems = $filter->transform($request);

        $customer = Customer::where($queryItems)
        ->whereHas('documentTypes', function ($query) {
            $query->where('type', 'RUC');
        })->with('typeRecords', 'documentTypes')->paginate()->appends($request->query());

        return new CustomerBusinessCollection($customer);
    }

    public function store(StoreCustomerRequest $request){
        DB::beginTransaction();
        Try{
            $customer = Customer::create([
                'name' => $request->input('name'),
                'paternal_surname' => $request->input('paternal_surname'),
                'maternal_surname' => $request->input('maternal_surname'),
                'date_of_birth' => $request->input('date_of_birth'),
                'business_name' => $request->input('business_name'),
                'fiscal_address' => $request->input('fiscal_address'),
                'email' => $request->input('email')
            ]);

            foreach ($request->input('document_types') as $documentsData) {
                $customer->documentTypes()->create($documentsData);
            }

            foreach ($request->input('phones') as $phonesData) {
                $customer->phones()->create($phonesData);
            }

            foreach ($request->input('addresses') as $addressesData) {
                $customer->addresses()->create($addressesData);
            }

            $customer->typeRecords()->create([
                'type' => 'MANUAL'
            ]);

            DB::commit();
            return response()->json(['message' => 'Cliente creado exitosamente'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear cliente: ' . $e->getMessage()], 500);
        }
    }

    public function show(Customer $customer){
        $customer->load('documentTypes', 'phones', 'addresses');
        return new CustomerResource($customer);
    }

    public function update(){

    }

    public function destroy(){

    }
}
