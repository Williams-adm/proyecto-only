<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('employees', EmployeeController::class);
    Route::get('phones/{phones}', [PhoneController::class, 'show']);
});