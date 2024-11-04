<?php

namespace App\Http\Controllers;

use App\Filters\InflowFilter;
use App\Http\Requests\StoreInflowRequest;
use App\Http\Resources\InflowCollection;
use App\Http\Resources\InflowResource;
use App\Models\Inflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InflowController extends Controller
{
    public function index(Request $request){
        $filter = new InflowFilter();
        $queryItems = $filter->transform($request);

        $inflow = Inflow::where($queryItems);
        return new InflowCollection($inflow->paginate()->appends($request->query()));
    }

    public function store(StoreInflowRequest $request){
        DB::beginTransaction();
        try{
            $inflow = Inflow::create([
                'operation' => $request->input('operation'),
                'type_voucher' => $request->input('type_voucher'),
                'num_voucher' => $request->input('num_voucher'),
                'total' => $request->input('total'),
                'reazon' => $request->input('reazon'),
                'path_voucher' => $request->input('path_voucher'),
                'supplier_id' => $request->input('supplier_id'),
                'branch_id' => $request->input('branch_id'),
            ]);

            foreach ($request->input('detail_inflow')as $detailInflowData){
                $inflow->inventories()->attach($detailInflowData['inventory_id'], [
                'quantity' => $detailInflowData['quantity'],
                'purcharse_price' => $detailInflowData['purcharse_price'],
                'profit' => $detailInflowData['profit']
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Entrada creada exitosamente'], 201);

        } catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Error al registrar la entrada: ' . $e->getMessage()], 500);
        }
    }

    public function show(Inflow $inflow){
        return new InflowResource($inflow);
    }

    public function update(){

    }

    public function delete(){

    }
}
