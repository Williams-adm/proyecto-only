<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoteCustomerController;
use App\Http\Controllers\NoteEmployeeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('employees', EmployeeController::class);
    Route::get('employees/{employee}/phones', [PhoneController::class, 'getPhonesByEmployee'])->name('phones.byEmployee');
    Route::patch('employees/{employee}/user', [UserController::class, 'update'])->name('user.update');
    Route::prefix('employees')->controller(NoteEmployeeController::class)->group(function (){
        Route::post('/{employee}/notes', 'storeNoteForEmployee')->name('storeNote.byEmployee');
        Route::get('/{employee}/notes', 'getNotesByEmployee')->name('notes.byEmployee') ;
        Route::match(['put', 'patch'], '/{employee}/notes/{note}', 'update')->name('notesEmployee.update');
        Route::delete('/{employee}/notes/{note}', 'destroy')->name('notesEmployee.destroy');
    });

    Route::get('customers/business', [CustomerController::class, 'indexBusiness'])->name('customerBusiness.index');
    Route::apiResource('customers', CustomerController::class);
    Route::get('customers/{customer}/phones', [PhoneController::class, 'getPhonesByCustomer'])->name('phones.byCustomer');
    Route::prefix('customers')->controller(NoteCustomerController::class)->group(function () {
        Route::post('/{customer}/notes', 'storeNoteForCustomer')->name('storeNote.byCustomer');
        Route::get('/{customer}/notes', 'getNotesByCustomer')->name('notes.byCustomer');
        Route::match(['put', 'patch'], '/{customer}/notes/{note}', 'update')->name('notesCustomer.update');
        Route::delete('/{customer}/notes/{note}', 'destroy')->name('notesCustomer.destroy');
    });
});