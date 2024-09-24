<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'note_text' => ['required', 'string'],
            'reminder_date' => ['required', 'date_format:Y-m-d'],
        ];
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
