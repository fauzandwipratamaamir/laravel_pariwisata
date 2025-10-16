<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, HomeController, PackageController, BookingController // <-- USER booking controller
};
use App\Http\Controllers\Admin\{
    CategoryController, DestinationController, TourPackageController,
    ItineraryItemController, PackageScheduleController, PackageImageController
};
use App\Http\Controllers\Admin\BookingController as AdminBookingController; // <-- ALIAS untuk ADMIN booking

// ------------------ Auth ------------------
Route::get('/login',    [AuthController::class,'showLogin'])->name('login');
Route::post('/login',   [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',  [AuthController::class,'logout'])->middleware('auth');

// ------------------ Publik ------------------
Route::get('/',                         [HomeController::class,'index']);
Route::get('/packages',                 [PackageController::class,'index'])->name('packages.index');
Route::get('/packages/{package:slug}',  [PackageController::class,'show'])->name('packages.show');

// ------------------ User (wajib login) ------------------
Route::middleware('auth')->group(function () {
    Route::get('/packages/{package:slug}/book',  [BookingController::class,'create'])->name('bookings.create');
    Route::post('/packages/{package:slug}/book', [BookingController::class,'store'])->name('bookings.store');
    Route::get('/my/bookings', [BookingController::class,'index'])->name('bookings.index');
    Route::post('/my/bookings/{booking}/upload-proof', [BookingController::class,'uploadProof'])
        ->name('bookings.upload_proof');
});

// ------------------ Admin (wajib admin) ------------------
Route::middleware(['auth','can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.index')->name('index');

    Route::resource('categories',   CategoryController::class);
    Route::resource('destinations', DestinationController::class);
    Route::resource('packages',     TourPackageController::class);
    Route::resource('itinerary',    ItineraryItemController::class)->only(['store','update','destroy']);
    Route::resource('schedules',    PackageScheduleController::class)->only(['store','update','destroy']);
    Route::resource('images',       PackageImageController::class)->only(['store','destroy']);

    // RESOURCE BOOKING ADMIN (yang dicari blade admin)
    Route::resource('bookings', AdminBookingController::class)
        ->only(['index','show','edit','update','destroy']);
});
