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
                'noteText' => ['required', 'string'],
                'reminderDate' => ['required', 'date_format:Y-m-d'],
                'completed' => ['required', 'boolean']
            ];
        }else{
            return[
                'noteText' => ['sometimes','required', 'string'],
                'reminderDate' => ['sometimes', 'required', 'date_format:Y-m-d'],
                'completed' => ['sometimes', 'required', 'boolean']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->has('reminderDate')) {
            $dateBirth = $this->input('reminderDate');
            $this->merge([
                'reminderDate' => Carbon::createFromFormat('d-m-Y', $dateBirth)->format('Y-m-d')
            ]);
        };

        if($this->noteText){
            $this->merge(['note_text' => $this->noteText]);
        }
        if($this->reminderDate){
            $this->merge(['reminder_date' => $this->reminderDate]);
        }
        if($this->completed){
            $this->merge(['completed' => $this->completed]);
        }
    }
}
