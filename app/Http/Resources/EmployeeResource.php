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
            'paternalSurname' => $this->paternal_surname, 
            'maternalSurname' => $this->maternal_surname, 
            'dateOfBirth' => $this->date_of_birth,
            'salary' => $this->salary,
            'paymentDate' => $this->payment_date,
            'photoPath' => $this->photo_path
        ];
    }
}
