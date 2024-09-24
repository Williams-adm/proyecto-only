<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'last_name' => $this->paternal_surname . " " . $this->maternal_surname, 
            'date_of_birth' => $this->date_of_birth,
            'salary' => $this->salary,
            'payment_date' => $this->payment_date,
            'photo_path' => $this->photo_path,
            'document_types' => DocumentTypeResource::collection($this->whenLoaded('documentTypes')),
            'phones' => PhoneResource::collection($this->whenLoaded('phones')),
            'address' => AddressResource::collection($this->whenLoaded('addresses')),
            'user' => new UserResource($this->whenLoaded('user')),
            'documents' => EmployeeDocumentResource::collection($this->whenLoaded('employeeDocuments'))
        ];
    }
}
