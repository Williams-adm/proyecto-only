<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
                'name' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,50'],
                'paternal_surname' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,25'],
                'maternal_surname' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,25'],
                'date_of_birth' => ['required', 'date_format:Y-m-d'],
                'salary' => ['required', 'numeric', 'between:0, 10000', 'decimal:2'],
                'payment_date' => ['required', 'string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
                'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                /* documentotype */
                'document_types.*.id' => ['required', 'exists:document_types,id'],
                'document_types.*.type' => ['required', 'string', Rule::in(['DNI', 'PASAPORTE', 'CARNET_EXT', 'RUC', 'OTROS'])],
                'document_types.*.number' => ['required', 'numeric', 'digits_between:6,15'],
                /* phones */
                'phones.*.id' => ['required', 'exists:phones,id'],
                'phones.*.prefix' => ['required', 'string', 'between:2,5'],
                'phones.*.number' => ['required', 'numeric', 'digits_between:2,12'],
                /* address */
                'addresses.*.id' => ['required', 'exists:addresses,id'],
                'addresses.*.country' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:20'],
                'addresses.*.region' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.province' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.city' => ['required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.street' => ['required', 'string', 'max:150'],
                'addresses.*.number' => ['required', 'string', 'between: 3,10'],
                /* user */
                'user.email' => ['required', 'email:rfc,dns', 'unique:users,email'],
                'user.password' => ['required', 'string', 'between:8,25'],
                /* employe documents */
                'employee_documents.*.id' => ['required', 'exists:employee_documents,id'],
                'employee_documents.*.document_type' => ['nullable', 'string', Rule::in(['CV', 'COPIA DE DI', 'OTROS'])],
                'employee_documents.*.document_path' => ['nullable', 'string']
            ];
        }else{
            return [
                'name' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,50'],
                'paternal_surname' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,25'],
                'maternal_surname' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'between:3,25'],
                'date_of_birth' => ['sometimes', 'required', 'date_format:Y-m-d'],
                'salary' => ['sometimes', 'required', 'numeric', 'between:0, 10000', 'decimal:2'],
                'payment_date' => ['sometimes', 'required', 'string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
                'photo_path' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                /* documentotype */
                'document_types.*.id' => ['nullable', 'exists:document_types,id'],
                'document_types.*.type' => ['sometimes', 'required', 'string', Rule::in(['DNI', 'PASAPORTE', 'CARNET_EXT', 'RUC', 'OTROS'])],
                'document_types.*.number' => ['sometimes', 'required', 'numeric', 'digits_between:6,15'],
                /* phones */
                'phones.*.id' => ['nullable', 'exists:phones,id'],
                'phones.*.prefix' => ['sometimes', 'required', 'string', 'between:2,5'],
                'phones.*.number' => ['sometimes', 'required', 'numeric', 'digits_between:2,12'],
                /* address */
                'addresses.*.id' => ['nullable', 'exists:addresses,id'],
                'addresses.*.country' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:20'],
                'addresses.*.region' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.province' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.city' => ['sometimes', 'required', 'string', 'regex:/^[\p{L}\s]+$/u', 'max:60'],
                'addresses.*.street' => ['sometimes', 'required', 'string', 'max:150'],
                'addresses.*.number' => ['sometimes', 'required', 'string', 'between: 3,10'],
                /* user */
                'user.email' => ['sometimes', 'required', 'email:rfc,dns', 'unique:users,email'],
                'user.password' => ['sometimes', 'required', 'string', 'between:8,25'],
                /* employe documents */
                'employee_documents.*.id' => ['nullable', 'exists:employee_documents,id'],
                'employee_documents.*.document_type' => ['sometimes', 'nullable', 'string', Rule::in(['CV', 'COPIA DE DI', 'OTROS'])],
                'employee_documents.*.document_path' => ['sometimes', 'nullable', 'string']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->has('date_of_birth')) {
            $dateBirth = $this->input('date_of_birth');
            $this->merge([
                'date_of_birth' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };

        if ($this->has('payment_date')) {
            $this->merge([
                'payment_date' => strtoupper($this->input('payment_date'))
            ]);
        }
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
                if (isset($address['country'])) {
                    $address['country'] = strtolower($address['country']);
                }
                if (isset($address['region'])) {
                    $address['region'] = strtolower($address['region']);
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

        if ($this->has('employee_documents')) {
            $employeeDocuments = $this->input('employee_documents');
            foreach ($employeeDocuments as &$document) {
                if (isset($document['document_type'])) {
                    $document['document_type'] = strtoupper($document['document_type']);
                }
                if (isset($document['document_path'])) {
                    $document['document_path'] = $document['document_path'];
                }
            }
            $this->merge(['employee_documents' => $employeeDocuments]);
        }
    }
}