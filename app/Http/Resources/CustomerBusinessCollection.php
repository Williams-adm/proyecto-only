<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerBusinessCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($customer){
                return[
                    'id' => $customer->id,
                    'business_name' => $customer->business_name,
                    'fiscal_address' => $customer->fiscal_address,
                    'document_types' => $customer->relationLoaded('documentTypes')
                    ? DocumentTypeResource::collection($customer->documentTypes)
                    : null,
                    'type_record' => $customer->relationLoaded('typeRecords')
                    ? TypeRecordResource::collection($customer->typeRecords)
                    : null,
                    'registration_date' => $customer->created_at,
                ];
            })->all(),
        ];
    }
}
