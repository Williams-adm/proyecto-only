<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInflow extends Model
{
    use HasFactory;
    protected $table = 'detail_inflow';
    public function inflow(){
        return $this->belongsTo(Inflow::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
