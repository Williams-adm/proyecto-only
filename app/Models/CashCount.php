<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashCount extends Model
{
    use HasFactory;

    public function CashTransactions(){
        return $this->hasMany(CashTransaction::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
