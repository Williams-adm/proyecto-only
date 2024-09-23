<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'data' => $this->collection->transform(function ($employee){
                return[
                    'id' => $employee->id,
                    'fullName' => $employee->name . ' ' . $employee->paternal_surname . ' ' . $employee->maternal_surname,
                    /* 'phone' => PhoneResource::collection($employee->whenLoaded('phones')), */
                    'user' => new UserResource($employee->whenLoaded('user')),
                    'roles' => RoleResource::collection($employee->whenLoaded('roles')),
                    'photo' => $employee->photo_path,
                    'registrarion_date' => $employee->created_at,
                ];
            })->all(),
        ];
    }
}
