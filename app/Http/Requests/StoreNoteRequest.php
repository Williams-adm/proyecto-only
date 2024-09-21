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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'noteText' => ['required', 'string'],
            'reminderDate' => ['required', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('reminderDate')) {
            $dateBirth = $this->input('reminderDate');
            $this->merge([
                'reminderDate' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };

        $this->merge([
            'note_text' => $this->noteText,
            'reminder_date' => $this->reminderDate,
        ]);
    }
}
