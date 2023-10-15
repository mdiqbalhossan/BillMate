<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'middleware' => ['auth','verified','is_admin']], function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Client resource Route
    Route::resource('client', ClientController::class);

    // Category resource Route
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);

    // Product resource Route
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);

    //Tax controller
    Route::resource('tax', \App\Http\Controllers\Admin\TaxController::class);

    //ExpensePurpose Route
    Route::resource('expense-purpose', \App\Http\Controllers\Admin\ExpensePurposeController::class);

});
