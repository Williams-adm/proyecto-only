<?php

namespace App\Http\Controllers;

use App\Filters\InflowFilter;
use App\Http\Resources\InflowCollection;
use App\Http\Resources\InflowResource;
use App\Models\Inflow;
use Illuminate\Http\Request;

class InflowController extends Controller
{
    public function index(Request $request){
        $filter = new InflowFilter();
        $queryItems = $filter->transform($request);

        $inflow = Inflow::where($queryItems);
        return new InflowCollection($inflow->paginate()->appends($request->query()));
    }

    public function store(){
        
    }

    public function show(Inflow $inflow){
        return new InflowResource($inflow);
    }

    public function update(){

    }

    public function delete(){

    }
}
