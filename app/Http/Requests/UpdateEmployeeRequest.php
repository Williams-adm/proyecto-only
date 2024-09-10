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
                'name' => ['required', 'string', 'alpha', 'between:3, 50'],
                'paternalSurname' => ['required', 'string', 'alpha', 'between:3, 25'],
                'maternalSurname' => ['required', 'string', 'alpha', 'between:3, 25'],
                'dateOfBirth' => ['required', 'date_format:Y-m-d'],
                'salary' => ['required', 'numeric', 'between:0, 10000', 'decimal:2'],
                'paymentDate' => ['required', 'string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
                'photoPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
            ];
        }else{
            return [
                'name' => ['sometimes', 'required', 'string', 'alpha', 'between:3, 50'],
                'paternalSurname' => ['sometimes', 'required', 'string', 'alpha', 'between:3, 25'],
                'maternalSurname' => ['sometimes', 'required', 'string', 'alpha', 'between:3, 25'],
                'dateOfBirth' => ['sometimes', 'required', 'date_format:Y-m-d'],
                'salary' => ['sometimes', 'required', 'numeric', 'between:0, 10000', 'decimal:2'],
                'paymentDate' => ['sometimes', 'required', 'string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
                'photoPath' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->has('dateOfBirth')) {
            $dateBirth = $this->input('dateOfBirth');
            $this->merge([
                'dateOfBirth' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };

        if ($this->has('paymentDate')) {
            $this->merge([
                'paymentDate' => strtoupper($this->input('paymentDate'))
            ]);
        }

        if($this->paternalSurname){
            $this->merge(['paternal_surname' => $this->paternalSurname]);
        }
        
        if($this->maternalSurname){
            $this->merge(['maternal_surname' => $this->maternalSurname]);
        }

        if($this->dateOfBirth){
            $this->merge(['date_of_birth' => $this->dateOfBirth]);
        }

        if($this->paymentDate){
            $this->merge(['payment_date' => $this->paymentDate]);
        }

        if($this->photoPath){
            $this->merge(['photo_path' => $this->photoPath]);
        }
    }
}
