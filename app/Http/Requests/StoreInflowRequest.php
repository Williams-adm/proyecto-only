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
            "operation" => ['required', 'string', 'between:5,55'],
            "type_voucher" => ['required', 'string', 'between:3,50'],
            "num_voucher" => ['required', 'string', 'between:3,15'],
            "path_voucher" => ['required',/* 'file', 'mimes:pdf' */],
            "total" => ['nullable','numeric', 'decimal:2'],
            "reazon" => ['nullable', 'string'],
            "supplier_id" => ['nullable', 'exists:suppliers,id', 'numeric'],
            "branch_id" => ['required', 'exists:branches,id', 'numeric'],
            "detail_inflow.*.quantity" => ['required', 'numeric', 'min:1'],
            "detail_inflow.*.purcharse_price" => ['nullable', 'numeric', 'decimal:2'],
            "detail_inflow.*.profit" => ['nullable', 'numeric', 'decimal:2'],
            "detail_inflow.*.inventory_id" => ['required', 'numeric', 'exists:inventory,id'],
        ];
    }
}
