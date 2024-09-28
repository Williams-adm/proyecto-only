<?php

namespace App\Http\Controllers;

use App\Filters\SupplierFilter;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request) {
        $filter = new SupplierFilter();
        $queryItems = $filter->transform($request);

        $supplier = Supplier::where($queryItems);
        return new SupplierCollection($supplier->paginate()->appends($request->query()));
    }

    public function store(StoreSupplierRequest $request) {
        Supplier::create($request->all());
        return response()->json(['message' => "El proveedor a sido creado"], 201);
    }

    public function show(Supplier $supplier) {
        return new SupplierResource($supplier);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier) {
        $supplier->update($request->all());
        return response()->json(['message' => "El proveedor con el id {$supplier->id} ha sido actualizado"], 200);
    }

    public function destroy(Supplier $supplier) {
        $supplier->delete();
        return response()->json(['message' => "El proveedor con el id {$supplier->id} ha sido eliminado"], 200);
    }
}
