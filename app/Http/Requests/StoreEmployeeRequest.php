<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
            'name' => ['required', 'string', 'alpha', 'between:3,50'],
            'paternalSurname' => ['required', 'string', 'alpha', 'between:3,25'],
            'maternalSurname' => ['required', 'string', 'alpha', 'between:3,25'],
            'dateOfBirth' => ['required', 'date_format:Y-m-d'],
            'salary' => ['required', 'numeric', 'between:0, 10000', 'decimal:2'],
            'paymentDate' => ['required','string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
            'photoPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            /* validacion para  documentTypes */
            'documentTypes.*.type' => ['required', 'string', Rule::in(['DNI','PASAPORTE', 'CARNET_EXT', 'RUC', 'OTROS'])], 
            'documentTypes.*.number' => ['required','numeric', 'digits_between:6,15'],
            /* validacion para phones */
            'phones.*.prefix' => ['required', 'string', 'between:2,5'],
            'phones.*.number' => ['required','numeric', 'digits_between:2,12'],
            /* /*validacion de address */
            'addresses.*.country' => ['required', 'string', 'max:20'],
            'addresses.*.region' => ['required', 'string', 'max:60'],
            'addresses.*.province' => ['required', 'string', 'max:60'],
            'addresses.*.city' => ['required', 'string', 'max:60'],
            'addresses.*.street' => ['required', 'string', 'max:150'],
            'addresses.*.number' => ['required', 'string', 'between: 3,10'],
            /* validacion usuario */
            'user.email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'user.password'=> ['required', 'string', 'between:8,25'],
            /*validacion de document employee*/
            'employeeDocuments.*.documentType' => ['nullable', 'string', Rule::in(['CV', 'COPIA DE DI', 'OTROS'])],
            'employeeDocuments.*.documentPath' => ['nullable', 'string']
        ];
    } 

    protected function prepareForValidation()
    {
        if ($this->has('dateOfBirth')) {
            $dateBirth = $this->input('dateOfBirth');
            $this->merge([
                'dateOfBirth' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };

        if($this->has('paymentDate')){
            $this->merge([
                'paymentDate' => strtoupper($this->input('paymentDate'))
            ]);
        }

        if ($this->has('documentTypes')) {
            $documentTypes = $this->input('documentTypes');
            foreach ($documentTypes as &$document) {
                if (isset($document['type'])) {
                    $document['type'] = strtoupper($document['type']);
                }
            }
            $this->merge(['documentTypes' => $documentTypes]);
        }

        if ($this->has('addresses')) {
            $addresses = $this->input('addresses');
            foreach ($addresses as &$address) {
                if (!isset($address['country'])) {
                    $address['country'] = 'Peru';
                }
                if (!isset($address['region'])) {
                    $address['region'] = 'Junin';
                }
                if(isset($address['province'])){
                    $address['province'] = ucwords($address['province']);
                }
                if(isset($address['city'])){
                    $address['city'] = ucwords($address['city']);
                }
                if(isset($address['street'])){
                    $address['street'] = ucwords($address['street']);
                }
            }
            $this->merge(['addresses' => $addresses]);
        }

       if ($this->has('employeeDocuments')) {
            $employeeDocuments = $this->input('employeeDocuments');
            foreach ($employeeDocuments as &$document) {
                if (isset($document['documentType'])) {
                    $document['documentType'] = strtoupper($document['documentType']);
                }
                if(isset($document['documentPath'])){
                    $document['document_path'] = $document['documentPath'];
                }
            }
            $this->merge(['employeeDocuments' => $employeeDocuments]);
        }
        
        $this->merge([
            'paternal_surname' => $this->paternalSurname,
            'maternal_surname' => $this->maternalSurname,
            'date_of_birth' => $this->dateOfBirth,
            'payment_date' => $this->paymentDate,
            'photo_path' => $this->photoPath,
            'document_types' => $this->documentTypes,
            'employee_documents' =>$this->employeeDocuments,
            'document_type' => $this->documentType,
        ]);
    }
}
