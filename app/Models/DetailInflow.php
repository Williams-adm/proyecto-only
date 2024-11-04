<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInflow extends Model
{
    use HasFactory;
    protected $table = 'detail_inflow';

    protected $fillable = [
        'quantity',
        'purcharse_price',
        'profit',
        'inflow_id',
        'inventory_id'
    ];

    
    public function inflow(){
        return $this->belongsTo(Inflow::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
