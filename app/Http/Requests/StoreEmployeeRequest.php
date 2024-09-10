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
            'name' => ['required', 'string', 'alpha', 'between:3, 50'],
            'paternalSurname' => ['required', 'string', 'alpha', 'between:3, 25'],
            'maternalSurname' => ['required', 'string', 'alpha', 'between:3, 25'],
            'dateOfBirth' => ['required', 'date_format:Y-m-d'],
            'salary' => ['required', 'numeric', 'between:0, 10000', 'decimal:2'],
            'paymentDate' => ['required','string', Rule::in(['FIN DE MES', 'QUINCENAL', 'SEMANAL'])],
            'photoPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
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

        $this->merge([
            'paternal_surname' => $this->paternalSurname,
            'maternal_surname' => $this->maternalSurname,
            'date_of_birth' => $this->dateOfBirth,
            'photo_path' => $this->photoPath
        ]);

        
    }
}
