<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outflow extends Model
{
    use HasFactory;

    public function inventories(){
        return $this->belongsToMany(Inventory::class, 'detail_outflow')
        ->withPivot('quantity')->withTimestamps();
    }
}
