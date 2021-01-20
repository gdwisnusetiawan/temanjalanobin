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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('faq', 'HomeController@faq')->name('faq');
Route::get('distributor', 'HomeController@distributor')->name('distributor');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('', 'ShopController@index')->name('index');
    Route::get('single', 'ShopController@single')->name('single');
    Route::get('single-ajax', 'ShopController@singleAjax')->name('single-ajax');
    Route::get('cart', 'ShopController@cart')->name('cart');
    Route::get('checkout', 'ShopController@checkout')->name('checkout');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('', 'NewsController@index')->name('index');
    Route::get('single', 'NewsController@single')->name('single');
});
