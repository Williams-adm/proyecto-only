<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function Employees(){
        return $this->belongsToMany(Employee::class);
    }

    public function Permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
