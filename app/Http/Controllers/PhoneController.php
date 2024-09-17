<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function show(Phone $phones){
        return new PhoneResource($phones);
    }
}
