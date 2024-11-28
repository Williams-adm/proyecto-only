<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($supplier){
                return[
                    "id" => $supplier->id,
                    "business_name" => $supplier->business_name,
                    "num_ruc" => $supplier->num_ruc,
                    "fiscal_address" => $supplier->fiscal_address,
                    "phone" => $supplier->phone,
                    "contac" => $supplier->contac,
                    "status" => $supplier->status
                ];
            })->all(),
        ];
    }
}
