<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($product) {
                return [
                    "id" => $product->id,
                    "name" => $product->name,
                    "code" => $product->code,
                    "status" => $product->status,
                    "category_name" => $product->category->name,
                    "cover_image_path" => $product->cover_image_path
                ];
            })->all(),
        ];
    }
}
