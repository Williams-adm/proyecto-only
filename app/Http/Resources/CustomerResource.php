<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isNull;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(!empty($this->name)){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'last_name' => $this->paternal_surname . " " . $this->maternal_surname,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
                'document_types' => DocumentTypeResource::collection($this->whenLoaded('documentTypes')),
                'phones' => PhoneResource::collection($this->whenLoaded('phones')),
                'address' => AddressResource::collection($this->whenLoaded('addresses')),
            ];
        }else{
            return [
                'id' => $this->id,
                'business_name' => $this->business_name,
                'fiscal_address' => $this->fiscal_address,
                'email' => $this->email,
                'document_types' => DocumentTypeResource::collection($this->whenLoaded('documentTypes')),
                'phones' => PhoneResource::collection($this->whenLoaded('phones')),
                'address' => AddressResource::collection($this->whenLoaded('addresses')),
            ];
        }
    }
}
