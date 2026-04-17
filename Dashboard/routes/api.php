<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

Route::resource('brands', \App\Http\Controllers\Api\BrandController::class);
Route::resource('cars', \App\Http\Controllers\Api\CarController::class);
Route::resource('drivers', \App\Http\Controllers\Api\DriverController::class);
Route::resource('loyalty_levels', \App\Http\Controllers\Api\LoyaltyLevelController::class);
Route::resource('payments',\App\Http\Controllers\Api\PaymentController::class);
Route::resource('rentals', \App\Http\Controllers\Api\RentalController::class);
Route::resource('users', \App\Http\Controllers\Api\UserController::class);


Route::patch('cars/{id}/status', [\App\Http\Controllers\Api\CarController::class, 'updateStatus']);
Route::patch('rentals/{id}/status', [\App\Http\Controllers\Api\RentalController::class, 'updateStatus']);



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
