<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required|string|alpha:ascii|digits_between:3, 50'],
            'paternalSurname' => ['required|string|alpha:ascii|digits_between:3, 25'],
            'maternalSurname' => ['required|string|alpha:ascii|digits_between:3, 25'],
            'dateOfBirth' => ['required|date_format:Y-m-d'],
            'salary' => ['required|numeric|min:0|max:10000', 'decimal:2'],
            'paymentDate' => ['required|string|alpha:ascii', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
            'photoPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    } 
    protected function prepareForValidation()
    {
        $this->merge([
            'paternal_surname' => $this->paternalSurname,
            'maternal_surname' => $this->maternalSurname,
            'date_of_birth' => $this->dateOfBirth,
            'paymentDate' => strtoupper($this->paymentDate),
            'photo_path' => $this->photoPath
        ]);

        if ($this->has('date_of_birth')) {
            $dateBirth = Carbon::createFromFormat('d-m-Y', $this->input('date_of_birth'))->format('Y-m-d');
            $this->merge(['date_of_birth' => $dateBirth]);
        };
    }
}
