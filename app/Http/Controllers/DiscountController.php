<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
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
                $discount->products()->attach($discountsData['product_id']);
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
}
