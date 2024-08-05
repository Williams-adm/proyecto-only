<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /* Relacion de 1 a 1 
    hasOne: Se usa en el modelo que no tiene la clave foránea. 
    Indica que este modelo tiene una relación de uno a uno con otro modelo. */
    public function user(){
        return $this->hasOne(User::class);
    }

    /* Relacion de 1 a muchos 
    
    */
    public function EmployeeDocuments(){
        return $this->hasMany(EmployeeDocument::class);
    }

    public function Sales(){
        return $this->hasMany(Sale::class);
    }

    /* Relacion muchos a muchos */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /* relacion 1 a muchos polimorfica */
    public function documenttypes(){
        return $this->morphMany(DocumentType::class , 'documentable');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
}
