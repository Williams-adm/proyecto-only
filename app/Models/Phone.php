<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected function phoneableType(): Attribute
    {
        return Attribute::make(
            
            get: fn($type) => 'Employee',
            /* get: function() {
                $typeMap = [
                    'App\Models\Employee' => 'Employee',
                    'App\Models\Customer' => 'Customer',
                ]; 

                return $typeMap[$this->phoneable_type] ?? 'Unknown';
            } */
        );
    }

    public function phoneable(){
        return $this->morphTo();
    }
}
