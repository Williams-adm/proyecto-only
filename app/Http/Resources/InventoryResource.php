<?php

namespace App\Http\Resources;

use App\Models\DetailImage;
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
                    $idDetail = $detail->pivot->id;
                    $img = DetailImageResource::collection(DetailImage::where('detail_value_id', $idDetail)->get());
                    return [
                        'id' => $idDetail,
                        'value' => $detail->pivot->value,
                        'img' => $img
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
