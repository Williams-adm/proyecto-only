<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_ruc',
        'business_name',
        'fiscal_address',
        'phone',
        'contac',
        'status'
    ];
    protected function businessName(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
            set: fn(string $value) => strtolower($value)
        );
    }
    
    protected function fiscalAddress(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
            set: fn(string $value) => strtolower($value)
        );
    }
    
    protected function contact(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value === null ? " " : ucwords($value),
            set: fn(?string $value) => $value === null ? null : strtolower($value)
        );
    }

    public function inflows(){
        return $this->hasMany(Inflow::class);
    }
}
