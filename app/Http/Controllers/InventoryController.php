<?php

namespace App\Http\Controllers;

use App\Filters\InventoryFilter;
use App\Http\Resources\InventoryCollection;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\StockMinMaxResource;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request){
        $filter = new InventoryFilter();
        $queryItems = $filter->transform($request);

        $inventory = Inventory::where($queryItems);
        return new InventoryCollection($inventory->paginate()->appends($request->query()));
    }


    public function show(Inventory $inventory){
        return new InventoryResource($inventory);
    }

    public function showStockMinMax(Inventory $inventory)
    {
        return new StockMinMaxResource($inventory);
    }


}
