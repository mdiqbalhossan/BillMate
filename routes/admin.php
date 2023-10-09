<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'middleware' => ['auth','verified','is_admin']], function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Client resource Route
    Route::resource('client', ClientController::class);

});
