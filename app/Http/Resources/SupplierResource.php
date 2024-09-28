<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "num_ruc" => $this->num_ruc,
            "business_name" => $this->business_name,
            "fiscal_address" => $this->fiscal_address,
            "phone" => $this->phone,
            "contac" => $this->contact,
        ];
    }
}
