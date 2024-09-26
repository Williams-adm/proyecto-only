<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

    public function TypeRecords(){
        return $this->hasMany(TypeRecord::class);
    }

    public function Sales(){
        return $this->hasMany(Sale::class);
    }

    public function documenttypes()
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
