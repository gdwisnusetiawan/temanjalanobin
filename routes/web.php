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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('faq', 'HomeController@faq')->name('faq');
Route::get('distributor', 'HomeController@distributor')->name('distributor');

Route::middleware('auth')->group(function () {
    Route::get('welcome', 'HomeController@welcome')->name('welcome');
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('{order}', 'CheckoutController@index')->name('index');
        Route::post('store', 'CheckoutController@store')->name('store');
    });
});

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('', 'ShopController@index')->name('index');
    Route::get('{category}', 'ShopController@index')->name('index');
    Route::get('{category}/{product}', 'ShopController@single')->name('single');
    Route::get('single-ajax', 'ShopController@singleAjax')->name('single-ajax');
});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('', 'CartController@index')->name('index');
    Route::post('store', 'CartController@store')->name('store');
    Route::put('update/{id}', 'CartController@update')->name('update');
    Route::delete('destroy/{id}', 'CartController@destroy')->name('destroy');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('', 'NewsController@index')->name('index');
    Route::get('single', 'NewsController@single')->name('single');
});

Route::get('{slug}', 'PageController@index')->name('page.index');
Route::get('{parent}/{slug}', 'PageController@show')->name('page.show');