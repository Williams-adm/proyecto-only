<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailImage extends Model
{
    use HasFactory;

    public function detailValue(){
        return $this->belongsTo(DetailValue::class, 'detail_value_id');
    }
}
