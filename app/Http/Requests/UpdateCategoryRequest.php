<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        if($method == 'PUT'){
            return [
                'name' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,50', 'unique:categories,name'],
                'description' => ['required', 'string'],
            ];
        }else{
            return [
                'name' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,50', 'unique:categories,name'],
                'description' => ['sometimes', 'required', 'string'],
                'satus' => ['sometimes', 'required', 'boolean']
            ];
        }

    }
}
