<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return[
                "name" => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,75', 'unique:products,name'],
                "description" => ['required', 'string', 'min:10'],
                "usage_recomendation" => ['nullable', 'string', 'min:10'],
                "additional_features" => ['nullable', 'string', 'min:10'],
                "category_id" => ['required', 'exists:categories,id', 'numeric'],
            ];
        }else{
            return[
                "name" => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,75', 'unique:products,name'],
                "description" => ['sometimes', 'required', 'string', 'min:10'],
                "usage_recomendation" => ['sometimes', 'nullable', 'string', 'min:10'],
                "additional_features" => ['sometimes', 'nullable', 'string', 'min:10'],
                "category_id" => ['sometimes', 'required', 'exists:categories,id', 'numeric'],
                "status" => ['sometimes', 'boolean']
            ];
        }
    }
}
