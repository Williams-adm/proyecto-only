<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DiscountCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($discount) {
                return [
                    'id' => $discount->id,
                    'name' => $discount->name,
                    'description' => $discount->description,
                    'porcentage' => $discount->porcentage,
                    'start_date' => $discount->start_date,
                    'end_date' => $discount->end_date
                ];
            })->all(),
        ];
    }
}
