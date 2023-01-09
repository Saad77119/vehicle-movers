<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index');
//Customers
Route::resource('customers', CustomerController::class);
Route::get('status/{id}', 'CustomerController@status');
//Drivers
Route::resource('drivers', DriverController::class);
Route::get('driver_status/{id}', 'DriverController@status');
//Permissions
Route::resource('permissions', PermissionController::class);
//ROLES
Route::resource('roles', RoleController::class);
//User
Route::resource('users', UserController::class);

//Vehicles
Route::resource('vehicles', VehicleController::class);
// Setup
Route::group(['middleware' => ['permission:setup']], function () {
    //Country
    Route::resource('country', CountryController::class);
    //City
    Route::resource('city', CityController::class);
    //CustomerType
    Route::resource('customer_types', CustomerTypeController::class);
    //Make
    Route::resource('makes', MakeController::class);
    //Car Model
    Route::resource('models', CarModelController::class);
    //Ports
    Route::resource('ports', PortController::class);
    //ChargesType
    Route::resource('charges_types', ChargesTypeController::class);
    //AddPayment
    Route::resource('add_payments', AddPaymentController::class);
});
//getMake
Route::get('get_models/{id}', 'VehicleController@getModels');
//getCity
Route::get('get_city/{id}', 'VehicleController@getCity');
//getPort
Route::get('get_port/{id}', 'VehicleController@getPort');
// api
require __DIR__.'/api.php';
// auth
require __DIR__.'/auth.php';

