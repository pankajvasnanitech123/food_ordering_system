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
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login-validate', 'App\Http\Controllers\Auth\LoginController@validateLogin')->name('login-validate');

Route::group(['middleware' => ['app.authenticate']], function() {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('items', 'App\Http\Controllers\ItemController@index')->name('items');
    Route::get('orders', 'App\Http\Controllers\OrderController@index')->name('orders');
});
