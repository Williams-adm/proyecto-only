<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
                'num_ruc' => ['required', 'numeric', 'min_digits:11', 'unique:suppliers,num_ruc'],
                'business_name' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'unique:suppliers,business_name'],
                'fiscal_address' => ['nullable', 'string', 'between:3,55', 'unique:suppliers,fiscal_address'],
                'phone' => ['required', 'numeric', 'digits_between:9,15', 'unique:suppliers,phone'],
                'contac' => ['nullable', 'string']
            ];
        }else{
            return[
                'num_ruc' => ['sometimes','required', 'numeric', 'min_digits:11', 'unique:suppliers,num_ruc'],
                'business_name' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'unique:suppliers,business_name'],
                'fiscal_address' => ['sometimes', 'nullable', 'string', 'between:3,55', 'unique:suppliers,fiscal_address'],
                'phone' => ['sometimes', 'required', 'numeric', 'digits_between:9,15', 'unique:suppliers,phone'],
                'contac' => ['sometimes', 'nullable', 'string'],
                'status' => ['sometimes', 'boolean']
            ];
        }  
    }
}
