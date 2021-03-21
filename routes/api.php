<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('rajaongkir')->name('rajaongkir.')->group(function () {
    Route::get('province/{id?}', 'RajaOngkirController@province')->name('province');
    Route::get('city/{province}/{id?}', 'RajaOngkirController@city')->name('city');
    // Route::post('cost', 'RajaOngkirController@city')->name('cost');
});