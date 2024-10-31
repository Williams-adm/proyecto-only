<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInflowRequest extends FormRequest
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
            "operation" => ['required', 'string'],
            "type_voucher" => ['required', ''],
            "num_voucher" => ['required', 'string', ''],
            "path_voucher" => ['required','file', 'mimes:pdf'],
            "total" => ['nullable','numeric', 'decimal:2'],
            "reazon" => ['nullable', 'string'],
            "supplier_id" => ['required', ''],
            "branch_id" => ['required', '']
        ];
    }
}
