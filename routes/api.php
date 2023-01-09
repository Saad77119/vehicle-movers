<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\CustomerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/showallusers', [AdminController::class , 'users']);
Route::post('/vehicleImages', [AdminController::class , 'vehicleImages']);
Route::post('/telleysheet', [AdminController::class , 'telleysheet']);
Route::post('/currentlocation', [AdminController::class , 'currentlocation']);


Route::get('/delverybydriverid/{id}', [CustomerController::class , 'delvery_on_driverid']);
Route::get('/delverydetails/{id}', [CustomerController::class , 'delverydetails']);
Route::get('/deliveries', [CustomerController::class , 'deliveries']);


Route::post('/uploadtellysheet', [DriverController::class , 'upload_tellysheet']);
Route::get('/delverydetails/{id}/{driver_id}', [DriverController::class , 'delverydetails']);
Route::get('/confirm_pickup/{vehicle_id}', [DriverController::class , 'confirm_pickup']);
Route::get('/confirm_dropof/{id}', [DriverController::class , 'confirm_dropof']);
Route::post('/update_images/', [DriverController::class , 'update_images']);
Route::post('/location_tracking', [DriverController::class , 'location_tracking']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
