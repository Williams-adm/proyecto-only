<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectionException;
use App\Exceptions\InvalidFilterException;
use App\Filters\SupplierFilter;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index(Request $request) {

        try{
            $filter = new SupplierFilter();
            $queryItems = $filter->transform($request);

            $perPage = $request->get('per_page', 15);
            if (!is_numeric($perPage) || $perPage <= 0) {
                return response()->json(['error' => 'El valor de "per_page" debe ser un número mayor que 0.'], 400);
            }

            $supplier = Supplier::where($queryItems)
                ->with('phones')
                ->paginate($perPage)
                ->appends($request->query());
            return new SupplierCollection($supplier);

        } catch (ConnectionException $e) {
            Log::error('Error de conexión: ' . $e->getMessage());
            return response()->json(['error' => 'Error de conexión. Por favor, inténtelo más tarde.'], 503);

        } catch (InvalidFilterException $e) {
            Log::error('Filtro inválido: ' . $e->getMessage());
            return response()->json(['error' => 'Filtro Invalido'], 400);

        } catch (QueryException $e) {
            Log::error('Error en la consulta de categorías: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener a los proveedores.'], 500);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function store(StoreSupplierRequest $request) {
        try{
            DB::beginTransaction();
            $supplier = Supplier::create([
                'num_ruc' => $request->input('num_ruc'),
                'business_name' => $request->input('business_name'),
                'fiscal_address' => $request->input('fiscal_address'),
                'contac' => $request->input('contac'),
            ]);

            foreach($request->input('phone') as $phoneData){
                $supplier->phones()->create($phoneData);
            }
            
            DB::commit();
            return response()->json(['message' => "El proveedor a sido creado"], 201);

        } catch (ConnectionException $e) {
            Log::error('Error de conexión: ' . $e->getMessage());
            return response()->json(['error' => 'Error de conexión. Por favor, inténtelo más tarde.'], 503);
        } catch (QueryException $e) {
            Log::error('Error al intentar crear la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar crear el proveedor'], 400);
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function show(Supplier $supplier) {
        $supplier->load('phones');
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
