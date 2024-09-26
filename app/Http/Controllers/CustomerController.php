<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\CustomerFilter;
use App\Http\Resources\CustomerCollection;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request){
        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);

        $customer = Customer::where($queryItems);
        return new CustomerCollection($customer->paginate()->appends($request->query()));
    }

    public function store(){

    }

    public function show(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
