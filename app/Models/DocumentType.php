<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'number',
        'documentable_id',
        'documentable_type'
    ];
    
    public function documentable(){
        return $this->morphTo();
    }
}
