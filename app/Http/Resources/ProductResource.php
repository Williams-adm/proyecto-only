<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name" => $this->name,
            "code" => $this->code,
            "description" => $this->description,
            "usage_recomendation" => $this->usage_recomendation,
            "additional_features" => $this->additional_features,
            "category_name" => $this->category->name,
            "cover_image_path" => $this->cover_image_path
        ];
    }
}
