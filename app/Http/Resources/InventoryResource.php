<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Agrupar los detalles por 'type' y consolidar los valores en un array
        $groupedDetails = $this->product->details->groupBy('type')->map(function ($details, $type) {
            return [
                'type' => $type,
                'values' => $details->map(function ($detail) {
                    return [
                        'product_id' => $detail->pivot->product_id,
                        'detail_id' => $detail->pivot->detail_id,
                        'value' => $detail->pivot->value,
                    ];
                })
            ];
        })->values(); // Convertir el resultado a un array de valores.

        return [
            'id' => $this->id,
            'code' => $this->product->code,
            'product' => $this->product->name,
            'category' => $this->product->category->name,
            'selling_price' => $this->selling_price,
            'description' => $this->product->description,
            'usage_recomendation' => $this->product->usage_recomendation,
            'additional_features' => $this->product->additional_features,
            'detail_value' => $groupedDetails
        ];
    }
}
