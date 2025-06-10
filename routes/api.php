<?php

use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'mobile_login']);
Route::post('/update-driver', [DriverController::class, 'update_driver']);
Route::post('/new-booking', [BookingController::class, 'add_booking']);
Route::get('/booking/status/{id}', [BookingController::class, 'booking_update']);
Route::delete('/booking/delete/{id}', [BookingController::class, 'booking_delete']);
Route::get('/booking/list/{driver_id}', [BookingController::class, 'booking_list']);

Route::get('/booking/details/{id}', [BookingController::class, 'booking_details']);
Route::get('/dashboard-items/{driver_id}', [BookingController::class, 'dashborad_items']);


