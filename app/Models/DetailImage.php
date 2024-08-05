<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailImage extends Model
{
    use HasFactory;

    public function detailvalue(){
        return $this->belongsTo(DetailValue::class, 'detail_value_id');
    }
}
