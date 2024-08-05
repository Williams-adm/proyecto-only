<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailValue extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function detail(){
        return $this->belongsTo(Detail::class);
    }

    public function detailimages(){
        return $this->hasMany(DetailImage::class);
    }
}
