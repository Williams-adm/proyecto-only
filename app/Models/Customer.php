<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

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
