<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function inventory(){
        /* relacion de 1 a n */
        return $this->hasMany(Inventory::class);
    }

    public function discounts(){
        return $this->belongsToMany(Discount::class);
    }

    public function details(){
        return $this->belongsToMany(Detail::class, 'detail_value')->withPivot('value')
        ->withTimestamps();
    }
}
