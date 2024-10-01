<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
            'name' => ['required','string', 'regex:/^[\p{L}\s]+$/u', 'between:5,60', 'unique:branches,name'],
            'address' => ['required', 'string', 'unique:branches,address'],
            'prefix' => ['required', 'string', 'between:2,5'],
            'phone' => ['required', 'numeric', 'digits_between:2,12', 'unique:branches,phone'],
        ];
    }
}
