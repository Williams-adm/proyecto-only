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
            'lastName' => $this->paternal_surname . " " . $this->maternal_surname, 
            'dateOfBirth' => $this->date_of_birth,
            'salary' => $this->salary,
            'paymentDate' => $this->payment_date,
            'photoPath' => $this->photo_path,
            'documentTypes' => DocumentTypeResource::collection($this->whenLoaded('documentTypes')),
            'phones' => PhoneResource::collection($this->whenLoaded('phones')),
            'address' => AddressResource::collection($this->whenLoaded('addresses')),
            'user' => new UserResource($this->whenLoaded('user')),
            'documents' => EmployeeDocumentResource::collection($this->whenLoaded('employeeDocuments'))
        ];
    }
}
