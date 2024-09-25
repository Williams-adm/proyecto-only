<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, Employee $employee){
        $user = $employee->user;
        if($user){
            if(!empty($request['password'])){
                $request['password'] = Hash::make($request['password']);
            }
            $user->update($request->all());
            return response()->json(['message' => 'User actualizado correctamente'], 200);
        }else{
            return response()->json(['error' => 'User no existe'], 404);
        }

    }
}
