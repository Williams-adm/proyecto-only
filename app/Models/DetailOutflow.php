<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOutflow extends Model
{
    use HasFactory;
    protected $table = 'detail_outflow';
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function outflow(){
        return $this->belongsTo(Outflow::class);
    }
}
