<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;
    protected $table = 'detail_sale';
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
