<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'region',
        'province',
        'city',
        'street',
        'number',
    ];

    protected function country(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    protected function region(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    protected function province(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    protected function street(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    public function getaddressableTypeAttribute()
    {
        $typeMap = [
            'App\Models\Employee' => 'Employee',
            'App\Models\Customer' => 'Customer',
        ];

        return $typeMap[$this->attributes['addressable_type']] ?? 'Unknown';
    }

    public function addressable(){
        return $this->morphTo();
    }
}
