<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InflowCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'data' => $this->collection->transform(function ($inflow){
                return[
                    'id' => $inflow->id,
                    'operation' => $inflow->operation,
                    'type_voucher' => $inflow->type_voucher,
                    'num_voucher' => $inflow->num_voucher,
                    'path_voucher' => $inflow->path_voucher,
                    'total' => $inflow->total,
                    'branch' => $inflow->branch->name,
                    'supplier' => $inflow->supplier->business_name
                ];
            })->all(),
        ];
    }
}
