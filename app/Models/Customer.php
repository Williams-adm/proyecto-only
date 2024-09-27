<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'date_of_birth',
        'business_name',
        'fiscal_address',
        'email'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? ucwords($value) : '', /* Accesor Formateo para la vista */
            set: fn(?string $value) => $value === null ? null : strtolower($value)/* Mutador como se guarda en la db */
        );
    }

    protected function paternalSurname(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) =>$value ? ucwords($value) : '',
            set: fn(?string $value) => $value === null ? null : strtolower($value)
        );
    }

    protected function maternalSurname(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? ucwords($value) : '',
            set: fn(?string $value) => $value === null ? null : strtolower($value)
        );
    }

    protected function businessName(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? ucwords($value) : '',
            set: fn(?string $value) => $value === null ? null : strtolower($value)
        );
    }
    protected function fiscalAddress(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? ucwords($value) : '',
            set: fn(?string $value) => $value === null ? null : strtolower($value)
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

    public function typeRecords(){
        return $this->hasMany(TypeRecord::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function documentTypes()
    {
        return $this->morphMany(DocumentType::class, 'documentable');
    }

    public function phones(){
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }

    public function notes(){
        return $this->morphMany(Note::class, 'noteable');
    }
}
