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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/modal', function () {
    return view('modal');
});

Route::get('mailable', function () {
    $user = App\User::find(3);
    $payment = App\Payment::find(11);

    // return new App\Mail\Registered($user);
    return new App\Mail\Ordered($payment);
});

Auth::routes(['verify' => true]);
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('register/{referal?}', 'Auth\RegisterController@showRegistrationForm');

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');
// Route::get('new-arrival', 'HomeController@newArrival')->name('newArrival');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', 'DashboardController@index')->name('index');
        Route::get('welcome', 'DashboardController@welcome')->name('welcome');
        Route::prefix('transaction')->group(function () {
            Route::get('order', 'DashboardController@order')->name('order');
            Route::get('invoice/{payment}', 'DashboardController@invoice')->name('invoice');
            Route::get('payment/{payment}', 'DashboardController@payment')->name('payment');
            Route::post('change-payment-status/{payment}', 'DashboardController@changePaymentStatus')->name('changePaymentStatus');
            Route::put('confirm-payment/{payment}', 'DashboardController@confirmPayment')->name('confirmPayment');
            Route::put('cancel-payment/{payment}', 'DashboardController@cancelPayment')->name('cancelPayment');
            Route::put('change-address/{payment}', 'DashboardController@changeAddress')->name('changeAddress');
            Route::put('cancel-order/{order}', 'DashboardController@cancelOrder')->name('cancelOrder');
        });
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('', 'UserController@index')->name('index');
            Route::put('update/{user}', 'UserController@update')->name('update');
            Route::put('change-password/{user}', 'UserController@changePassword')->name('changePassword');
            Route::put('change-avatar/{user}', 'UserController@changeAvatar')->name('changeAvatar');
            Route::put('billing/{user}', 'UserController@billing')->name('billing');
            Route::get('registration/{user}', 'UserController@registration')->name('registration');
            Route::put('register-business/{user}', 'UserController@registerBusiness')->name('registerBusiness');
            Route::put('upload/{user}', 'UserController@upload')->name('upload');
        });
    });
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('{payment}', 'CheckoutController@index')->name('index');
        Route::post('store', 'CheckoutController@store')->name('store');
        Route::put('update/{payment}', 'CheckoutController@update')->name('update');
        Route::post('shipping/{payment}', 'CheckoutController@shipping')->name('shipping');
        Route::put('change-shipping/{payment}', 'CheckoutController@changeShipping')->name('changeShipping');
    });
});

Route::prefix('categories')->name('shop.')->group(function () {
    Route::get('', 'ShopController@index')->name('index');
    Route::get('{category}', 'ShopController@index')->name('index');
    Route::get('{category}/products/{product}/{referal?}', 'ShopController@single')->name('single');
    Route::get('single-ajax', 'ShopController@singleAjax')->name('single-ajax');
    Route::get('pricing/{product}', 'ShopController@pricing')->name('pricing');
});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('', 'CartController@index')->name('index');
    Route::post('store', 'CartController@store')->name('store');
    Route::put('update/{id}', 'CartController@update')->name('update');
    Route::delete('destroy/{id}', 'CartController@destroy')->name('destroy');
    Route::post('shipping', 'CartController@shipping')->name('shipping');
    Route::put('change-shipping', 'CartController@changeShipping')->name('changeShipping');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('', 'NewsController@index')->name('index');
    Route::get('single', 'NewsController@single')->name('single');
});

Route::prefix('rajaongkir')->name('rajaongkir.')->group(function () {
    // Route::get('province/{id?}', 'RajaOngkirController@province')->name('province');
    // Route::get('city/{province}/{id?}', 'RajaOngkirController@city')->name('city');
    // Route::post('cost', 'RajaOngkirController@city')->name('cost');
});

Route::prefix('shipment')->name('shipment.')->group(function () {
    Route::get('jnt/cost', 'ShipmentController@jntCost')->name('jnt.cost');
    Route::get('jnt/order', 'ShipmentController@jntOrder')->name('jnt.order');
    Route::get('jnt/track', 'ShipmentController@jntTrack')->name('jnt.track');
    Route::get('ncs/cost', 'ShipmentController@ncsCost')->name('ncs.cost');
    Route::get('rajaongkir/province/{id?}', 'ShipmentController@rajaongkirProvince')->name('rajaongkir.province');
    Route::get('rajaongkir/city/{province}/{id?}', 'ShipmentController@rajaongkirCity')->name('rajaongkir.city');
    Route::get('rajaongkir/subdistrict/{city}/{id?}', 'ShipmentController@rajaongkirSubdistrict')->name('rajaongkir.subdistrict');
    Route::post('rajaongkir/cost', 'ShipmentController@rajaongkirCost')->name('rajaongkir.cost');
    Route::get('rajaongkir/country/{id?}', 'ShipmentController@rajaongkirCountry')->name('rajaongkir.country');
});

Route::post('currency', 'HomeController@currency')->name('currency');
Route::get('currency/convert/{value}', 'HomeController@convertCurrency')->name('currency.convert');
Route::post('cookie/get', 'HomeController@getCookie')->name('cookie.get');
Route::post('cookie/set', 'HomeController@setCookie')->name('cookie.set');

Route::get('{slug}', 'PageController@index')->name('page.index');
Route::get('{parent}/{slug}', 'PageController@show')->name('page.show');


// URL::forceScheme('https');
