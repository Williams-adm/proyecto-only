<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'note_text',
        'reminder_date',
        'completed',
        'noteable_id',
        'noteable_type'
    ];

    protected function reminderDate(): Attribute{
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

    public function getNoteableTypeAttribute()
    {
        $typeMap = [
            'App\Models\Employee' => 'Employee',
            'App\Models\Customer' => 'Customer',
        ];

        return $typeMap[$this->attributes['noteable_type']] ?? 'Unknown';
    }
    
    public function noteable(){
        return $this->morphTo();
    }
}
