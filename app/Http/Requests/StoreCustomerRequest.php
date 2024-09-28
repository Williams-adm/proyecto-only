<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,65'],
            'paternal_surname' => ['nullable', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,65'],
            'maternal_surname' => ['nullable', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,65'],
            'date_of_birth' => ['nullable', 'date_format:Y-m-d'],
            'business_name' => ['nullable', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,85'],
            'fiscal_address' => ['nullable', 'string', 'between:3,85'],
            'email' => ['nullable', 'email:rfc,dns', 'unique:customers,email'],
            /* validacion para  documentTypes */
            'document_types.*.type' => ['required', 'string', Rule::in(['DNI', 'PASAPORTE', 'CARNET_EXT', 'RUC', 'OTROS'])],
            'document_types.*.number' => ['required', 'numeric', 'digits_between:6,15'],
            /* validacion para phones */
            'phones.*.prefix' => ['required', 'string', 'between:2,5'],
            'phones.*.number' => ['required', 'numeric', 'digits_between:2,12'],
            /*validacion de address */
            'addresses.*.country' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:20'],
            'addresses.*.region' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
            'addresses.*.province' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
            'addresses.*.city' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
            'addresses.*.street' => ['required', 'string', 'max:150'],
            'addresses.*.number' => ['required', 'string', 'between: 3,10'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('document_types')) {
            $documentTypes = $this->input('document_types');
            foreach ($documentTypes as &$document) {
                if (isset($document['type'])) {
                    $document['type'] = strtoupper($document['type']);
                }
            }
            $this->merge(['document_types' => $documentTypes]);
        }

        if ($this->has('addresses')) {
            $addresses = $this->input('addresses');
            foreach ($addresses as &$address) {
                if (!isset($address['country'])) {
                    $address['country'] = 'peru';
                }
                if (!isset($address['region'])) {
                    $address['region'] = 'junin';
                }
                if (isset($address['province'])) {
                    $address['province'] = strtolower($address['province']);
                }
                if (isset($address['city'])) {
                    $address['city'] = strtolower($address['city']);
                }
                if (isset($address['street'])) {
                    $address['street'] = strtolower($address['street']);
                }
            }
            $this->merge(['addresses' => $addresses]);
        }
    }
}
