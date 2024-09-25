<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'status'
    ];
    /* Relacion de 1 a 1 
    belongsTo: Se usa en el modelo que tiene la clave foránea. 
    Indica que este modelo pertenece a otro. */

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
