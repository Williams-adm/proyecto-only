<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NoteCustomerController;
use App\Http\Controllers\NoteEmployeeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('suppliers', SupplierController::class);

    Route::apiResource('inventory', InventoryController::class);
    Route::prefix('inventory')->controller(InventoryController::class)->group(function (){
        Route::get('/{inventory}/stocks', 'showStockMinMax')->name('StockMinMax.show');
    });

    Route::prefix('branches')->controller(BranchController::class)->group(function () {
        Route::get('/', 'index')->name('branches.index');
        Route::post('/', 'store')->name('branches.store');
        Route::match(['put', 'patch'], '/{branch}', 'update')->name('branches.update');
        Route::delete('/{branch}', 'destroy')->name('branches.destroy');
    });

    Route::apiResource('discounts', DiscountController::class);
    Route::prefix('discounts')->controller(DiscountController::class)->group(function () {
        Route::post('/inventory', 'storeDiscountInventary')->name('discountInventary.store');
        Route::delete('/{discount}/inventory/{inventory}', 'destroyDiscountInventary')->name('discountInventary.destroy');
    });

});