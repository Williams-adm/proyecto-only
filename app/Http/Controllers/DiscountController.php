<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountInventoryRequest;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountCollection;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index(){
        $discount = Discount::paginate();
        return new DiscountCollection($discount);
    }

    public function store(StoreDiscountRequest $request){
        DB::beginTransaction();
        try{
            $discount = Discount::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'porcentage' => $request->input('porcentage'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);

            foreach ($request->input('discount_product') as $discountsData) {
                $discount->inventories()->attach($discountsData['inventory_id']);
            }

            DB::commit();
            return response()->json(['message' => "Los decuentos han sido creados"], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear descuento: ' . $e->getMessage()], 500);
        }
    }

    public function storeDiscountInventary(StoreDiscountInventoryRequest $request){
        $exists = DB::table('discount_inventory')
            ->where('id', $request->inventory_id)
            ->where('id', $request->discount_inventory)
            ->first();

        if($exists){
            return response()->json(['Este producto ya se encuentra registrado en ese descuento'], 400);
        }
        
        try{
            Discount::find($request->discount_id)->inventories()->attach($request->inventory_id);
            return response()->json(['message' => 'Registro creado con éxito'], 201);
            
        }catch (\Illuminate\Database\QueryException $e){
            if ($e->getCode() === '23000') { 
                return response()->json(['error' => 'No se puede agregar este producto a este descuento porque ya existe.'], 400);
            }
            return response()->json(['error' => 'Ocurrió un error al intentar crear el registro.'], 500);
        }
    }


    public function show(Discount $discount){
        return new DiscountResource($discount);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount){
        $discount->update($request->all());

        if ($request->has('discount_product')) {
            foreach ($request->input('discount_product') as $discountsData) {
                if (isset($discountsData['id'])) {
                    $pivot = DB::table('discount_inventory')
                        ->where('id', $discountsData['id'])
                        ->where('discount_id', $discount->id)
                        ->first();
                    if($pivot){
                        DB::table('discount_inventory')
                        ->where('id', $pivot->id)
                        ->update($discountsData);
                    }else{
                        return response()->json(['error' => 'Este productono está relacionado con este descuento.'], 403);
                    }
                } else {
                    return response()->json(['error' => 'El id del producto no está presente.'], 400);
                }
            }
        }
        return response()->json(['message' => "El descuento con el id {$discount->id} ha sido actualizado"], 200);
    }

    public function destroy(Discount $discount){
        $discount->delete();
        return response()->json(['message' => "El descuento con el id {$discount->id} ha sido eliminado"], 200);
    }

    public function destroyDiscountInventary($discount, $inventory){
        $exists = DB::table('discount_inventory')
            ->where('discount_id', $discount)
            ->where('inventory_id', $inventory)
            ->exists();

        if (!$exists) {
            return response()->json(['error' => 'No se encontró la relación entre este descuento y producto.'], 404);
        }

        try {
            Discount::find($discount)->inventories()->detach($inventory);
            return response()->json(['message' => 'Registro eliminado con éxito'], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Ocurrió un error al intentar eliminar el registro.'], 500);
        }
    }
}
