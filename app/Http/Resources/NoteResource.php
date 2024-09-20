<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'noteText' => $this->note_text,
            'reminderDate' => $this->reminder_date,
            'completed' => $this->completed,
            'noteableId' => $this->noteable_id,
            'noteableType' => $this->noteable_type 
        ];
    }
}
