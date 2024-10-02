<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'porcentage',
        'start_date',
        'end_date'
    ];

    public function inventories(){
        return $this->belongsToMany(Inventory::class)->withTimestamps();;
    }
}
