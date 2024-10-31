<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InflowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'operation' => $this->operation,
            'type_voucher' => $this->type_voucher,
            'num_voucher' => $this->num_voucher,
            'path_voucher' => $this->path_voucher,
            'total' => $this->total,
            'branch' => $this->branch->name,
            'supplier' => $this->supplier->business_name,
            'inventory' => $this->inventories->transform(function($inventory){
                return[
                    'product' => $inventory->product->name,
                    'quantity' => $inventory->pivot->quantity,
                    'purcharse_price' => $inventory->pivot->purcharse_price,
                    'profit' => $inventory->pivot->profit
                ];
            })
        ];
    }
}
