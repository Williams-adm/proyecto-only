<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function geNoteableTypeAttribute()
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
