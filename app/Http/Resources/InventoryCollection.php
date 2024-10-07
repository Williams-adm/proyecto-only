<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InventoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($inventory) {
                return [
                    'id' => $inventory->id,
                    'code' => $inventory->product->code,
                    'product' => $inventory->product->name,
                    'category' => $inventory->product->category->name,
                    'current_stock' => $inventory->current_stock,
                    'selling_price' => $inventory->selling_price,
                    'branch_id' => $inventory->branch->name,
                    'status' => $inventory->status,
                ];
            })->all(),
        ];
    }
}
