<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'employee_id',
        'document_path',
    ];

    /* Relacion 1 a muchos inversa

    */
    protected function documentPath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::url($value),
        );
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
