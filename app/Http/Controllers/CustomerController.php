<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\CustomerFilter;
use App\Filters\CustomerBusinessFilter;
use App\Http\Resources\CustomerBusinessCollection;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

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

    public function store(){

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
