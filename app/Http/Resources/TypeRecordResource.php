<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastRecord = $this->customer()->orderBy('id', 'desc')->first();
        if($lastRecord)
        return [
            'id' => $this->id,
            'type' => $this->type,
            'customer_id' => $this->customer_id
        ];
    }
}
