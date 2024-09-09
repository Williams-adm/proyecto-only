<?php

namespace App\Http\Requests;

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
            'paternal_surname' => ['required|string|alpha:ascii|digits_between:3, 25'],
            'maternal_surname' => ['required|string|alpha:ascii|digits_between:3, 25'],
            'date_of_brith' => ['required|date_format:Y-m-d'],
            'salary' => ['required|numeric|min:0|max:10000', 'decimal:2'],
            'payment_date' => ['required', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        protected function prepareForValidation()
        {
            if()
        }
    }
}
