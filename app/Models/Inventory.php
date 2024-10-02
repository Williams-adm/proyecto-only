<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class)->withTimestamps();;
    }
    
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    //muchos a muchos con un modelo de tabla intermedia
    public function inflows(){
        return $this->belongsToMany(Inflow::class, 'detail_inflow')
        ->withPivot('quantity', 'purcharse_price', 'profit')
        ->withTimestamps();
    }

    public function outflows(){
        return $this->belongsToMany(Outflow::class, 'detail_outflow')
        ->withPivot('quantity')->withTimestamps();
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'detail_sale')
        ->withPivot('quantity', 'discount', 'unit_price', 'amount')->withTimestamps();
    }
}
