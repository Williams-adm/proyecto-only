<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function sales(){
        return $this->belongsToMany(Sale::class , 'payment_method_sale')
        ->withPivot('quantity')->withTimestamps();
    }
}
