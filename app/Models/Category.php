<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected function name(): Attribute{
        return Attribute::make(
            get: fn(string $value) => ucwords($value), /* Accesor Formateo para la vista */
            set: fn(string $value) => strtolower($value), /* Accesor Formateo para la vista */
        );
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
