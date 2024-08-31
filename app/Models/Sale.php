<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function CashCount(){
        return $this->belongsTo(CashCount::class);
    }

    public function voucher(){
        return $this->hasOne(Voucher::class);
    }

    public function paymentmethods(){
        return $this->belongsToMany(PaymentMethod::class , 'payment_method_sale')
        ->withPivot('quantity')->withTimestamps();
    }

    public function inventories(){
        return $this->belongsToMany(Inventory::class , 'detail_sale')
        ->withPivot('quantity', 'discount' , 'unit_price' , 'amount')->withTimestamps();
    }
    
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
