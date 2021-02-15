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
            Route::get('invoice/{order}', 'DashboardController@invoice')->name('invoice');
            Route::get('payment/{payment}', 'DashboardController@payment')->name('payment');
            Route::put('confirm-payment/{payment}', 'DashboardController@confirmPayment')->name('confirmPayment');
            Route::put('upload-payment-proof/{payment}', 'DashboardController@uploadPaymentProof')->name('uploadPaymentProof');
            Route::delete('delete-payment-proof/{payment}', 'DashboardController@deletePaymentProof')->name('deletePaymentProof');
        });
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('{user}', 'UserController@index')->name('index');
            Route::put('update/{user}', 'UserController@update')->name('update');
            Route::put('change-password/{user}', 'UserController@changePassword')->name('changePassword');
            Route::put('billing/{user}', 'UserController@billing')->name('billing');
            Route::get('registration/{user}', 'UserController@registration')->name('registration');
            Route::put('register-business/{user}', 'UserController@registerBusiness')->name('registerBusiness');
            Route::put('upload/{user}', 'UserController@upload')->name('upload');
        });
    });
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('{order}', 'CheckoutController@index')->name('index');
        Route::post('store', 'CheckoutController@store')->name('store');
        Route::put('update/{order}', 'CheckoutController@update')->name('update');
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

Route::get('{slug}', 'PageController@index')->name('page.index');
Route::get('{parent}/{slug}', 'PageController@show')->name('page.show');