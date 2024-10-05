<?php

namespace App\Http\Controllers;

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

    public function show(Discount $discount){
        return new DiscountResource($discount);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount){
        $discount->update($request->all());
        return response()->json(['message' => "La categoria con el id {$discount->id} ha sido actualizado"], 200);
    }

    public function destroy(Discount $discount){
        $discount->delete();
        return response()->json(['message' => "El descuento con el id {$discount->id} ha sido eliminado"], 200);
    }
}
