<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('cars', CarController::class);
});

Route::get('/', function () {
    return view('welcome');
});
