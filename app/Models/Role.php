<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
        );
    }

    public function employees(){
        return $this->belongsToMany(Employee::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
