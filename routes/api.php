<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('employees', EmployeeController::class);

    Route::get('employees/{employee}/phones', [PhoneController::class, 'getPhonesByEmployee'])->name('phones.byEmployee');

    Route::prefix('employees')->controller(NoteController::class)->group(function (){
        Route::post('/{employee}/notes', 'storeNoteForEmployee')->name('storeNote.byEmployee');
        Route::get('/{employee}/notes', 'getNotesByEmployee')->name('notes.byEmployee') ;
        Route::match(['put', 'patch'], '/{employee}/notes/{note}', 'update')->name('notesEmployee.update');
        Route::delete('/{employee}/notes/{note}', 'destroy')->name('notesEmployee.destroy');
    });
});