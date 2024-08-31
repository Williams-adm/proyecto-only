<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function products(){
        /* relacion de n a n */
        return $this->belongsToMany(Product::class, 'inventory')->withPivot('stock_min', 'stock_max', 'current_stock', 'selling_price',
        'status')->withTimestamps();
    }

    public function inflows(){
        return $this->hasMany(Inflow::class);
    }

    public function outflows()
    {
        return $this->hasMany(Outflow::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function cashCount()
    {
        return $this->hasMany(CashCount::class);
    }
}
