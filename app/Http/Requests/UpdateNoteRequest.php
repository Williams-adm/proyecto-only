<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
            return[
                'note_text' => ['required', 'string'],
                'reminder_date' => ['required', 'date_format:Y-m-d'],
                'completed' => ['required', 'boolean']
            ];
        }else{
            return[
                'note_text' => ['sometimes','required', 'string'],
                'reminder_date' => ['sometimes', 'required', 'date_format:Y-m-d'],
                'completed' => ['sometimes', 'required', 'boolean']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->has('reminder_date')) {
            $dateBirth = $this->input('reminder_date');
            $this->merge([
                'reminder_date' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };
    }
}