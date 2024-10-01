<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchCollection;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branch = Branch::paginate();
        return new BranchCollection($branch);
    }

    public function store(StoreBranchRequest $request) {
        Branch::create($request->all());
        return response()->json(['message' => "La sucursal a sido creada"], 201);
    }

    public function update(UpdateBranchRequest $request, Branch $branch){
        $branch->update($request->all());
        return response()->json(['message' => "La sucursal con el id {$branch->id} ha sido actualizado"], 200);
    }

    public function destroy(Branch $branch){
        $branch->delete();
        return response()->json(['message' => "La sucursal con el id {$branch->id} ha sido eliminado"], 200);
    }
}
