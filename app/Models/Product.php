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
        /* relacion de 1 a 1 */
        return $this->hasOne(Inventory::class);
    }

    public function discounts(){
        return $this->belongsToMany(Discount::class);
    }

    public function detailvalues(){
        return $this->hasMany(DetailValue::class);
    }
}
