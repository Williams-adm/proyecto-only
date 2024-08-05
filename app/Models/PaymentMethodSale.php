<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodSale extends Model
{
    use HasFactory;
    protected $table = 'payment_method_sale';
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function paymentmethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
