<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'date_of_birth',
        'salary',
        'payment_date',
        'photo_path' /* chekear cuando se ponga la ikmplementacion de foto */
    ];

    protected function name(): Attribute{
        return Attribute::make(
            get: fn (string $value) => ucwords($value), /* Accesor Formateo para la vista */
            set: fn(string $value) => strtolower($value)/* Mutador como se guarda en la db */
        );
    }

    protected function paternalSurname(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value)
        );
    }

    protected function maternalSurname(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value), 
            set: fn(string $value) => strtolower($value)
        );
    }

    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'), 
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }


    /* Relacion de 1 a 1 
    hasOne: Se usa en el modelo que no tiene la clave foránea. 
    Indica que este modelo tiene una relación de uno a uno con otro modelo. */
    public function user(){
        return $this->hasOne(User::class);
    }

    /* Relacion de 1 a muchos */
    public function employeeDocuments(){
        return $this->hasMany(EmployeeDocument::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    /* Relacion muchos a muchos */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /* relacion 1 a muchos polimorfica */
    public function documentTypes(){
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
