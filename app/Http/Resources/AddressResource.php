<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            /* 'country' => $this->country,
            'region' => $this->region, */
            'province' => $this->province,
            'city' => $this->city,
            'street' => $this->street . " " . $this->number,
            'addressable_id' => $this->addressable_id,
            'addressable_type' => $this->addressable_type
        ];
    }
}
