<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarImageController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarListingController::class, 'home'])->name('home');
Route::get('/cars', [CarListingController::class, 'index'])->name('cars.index');
Route::get('/cars/{slug}', [CarListingController::class, 'show'])->name('cars.show');
Route::post('/cars/{car:slug}/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::resource('cars', CarController::class);
    Route::delete('/car-images/{id}', [CarImageController::class, 'destroy'])->name('car-images.destroy');
    Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show'])->name('enquiries.show');
    Route::patch('/enquiries/{enquiry}/read', [AdminEnquiryController::class, 'markAsRead'])->name('enquiries.read');
});

require __DIR__.'/auth.php';