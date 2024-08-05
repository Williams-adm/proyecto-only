<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    use HasFactory;

    /* Relacion 1 a muchos inversa

    */
    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
