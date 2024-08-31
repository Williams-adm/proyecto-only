<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inflow extends Model
{
    use HasFactory;

    public function inventories(){
        return $this->belongsToMany(Inventory::class , 'detail_inflow')->
        withPivot('quantity', 'purcharse_price', 'profit')
        ->withTimestamps();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
