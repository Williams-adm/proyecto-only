<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'porcentage' => $this->porcentage,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'inventory' => $this->inventories->transform(function ($inventory) {
                return [
                    'id_registration' => $inventory->pivot->id,
                    'inventory_id' => $inventory->id,
                    'name' => $inventory->product->name,
                ];
            })->all(),
        ];
    }
}
