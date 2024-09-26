<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function branches(){
        /* relacion de n a n */
        return $this->belongsToMany(Branch::class, 'inventory')->withPivot('stock_min', 'stock_max', 'current_stock', 'selling_price',
        'status')->withTimestamps();
    }

    public function discounts(){
        return $this->belongsToMany(Discount::class);
    }

    public function details(){
        return $this->belongsToMany(Detail::class, 'detail_value')->withPivot('value')
        ->withTimestamps();
    }
}
