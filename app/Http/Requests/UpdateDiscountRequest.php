<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
                'name' => ['required', 'string', 'between:10,55',],
                'description' => ['required', 'string'],
                'porcentage' => ['required', 'numeric', 'decimal:2', 'max:4'],
                'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
                'end_date' => ['required', 'date_format:Y-m-d H:i:s'],
                'discount_product.*.id' => ['required', 'exists:discount_inventory,id'],
                'discount_product.*.inventory_id' => ['required', 'exists:inventory,id', 'numeric']
            ];
        }else{
            return [
                'name' => ['sometimes', 'required', 'string', 'between:10,55',],
                'description' => ['sometimes', 'required', 'string'],
                'porcentage' => ['sometimes', 'required', 'numeric', 'decimal:2', 'max:4'],
                'start_date' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
                'end_date' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
                'discount_product.*.id' => ['required', 'exists:discount_inventory,id'],
                'discount_product.*.inventory_id' => ['sometimes', 'required', 'exists:inventory,id', 'numeric']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->has('start_date')) {
            $startDate = $this->input('start_date');
            $this->merge([
                'start_date' => Carbon::createFromFormat('d-m-Y H:i:s', $startDate)->format('Y-m-d H:i:s')
            ]);
        };

        if ($this->has('end_date')) {
            $endDate = $this->input('end_date');
            $this->merge([
                'end_date' => Carbon::createFromFormat('d-m-Y H:i:s', $endDate)->format('Y-m-d H:i:s')
            ]);
        };
    }
}
