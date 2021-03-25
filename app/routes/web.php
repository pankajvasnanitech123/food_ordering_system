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

    // Items route
    Route::get('items', 'App\Http\Controllers\ItemController@index')->name('items');
    Route::get('items/create', 'App\Http\Controllers\ItemController@create')->name('items.create');
    Route::post('items/store', 'App\Http\Controllers\ItemController@store')->name('items.store');
    Route::get('items/show', 'App\Http\Controllers\ItemController@show')->name('items.show');
    Route::get('items/delete', 'App\Http\Controllers\ItemController@delete')->name('items.delete');
    Route::get('items/edit/{id}', 'App\Http\Controllers\ItemController@edit')->name('items.edit');
    Route::post('items/update/{id}', 'App\Http\Controllers\ItemController@update')->name('items.update');

    // Item Orders route
    Route::get('orders', 'App\Http\Controllers\OrderController@index')->name('orders');
    Route::get('orders/create', 'App\Http\Controllers\OrderController@create')->name('orders.create');
    Route::post('orders/store', 'App\Http\Controllers\OrderController@store')->name('orders.store');
    Route::get('orders/show', 'App\Http\Controllers\OrderController@show')->name('orders.show');
    Route::get('orders/delete', 'App\Http\Controllers\OrderController@delete')->name('orders.delete');
    Route::get('orders/edit/{id}', 'App\Http\Controllers\OrderController@edit')->name('orders.edit');
    Route::post('orders/update/{id}', 'App\Http\Controllers\OrderController@update')->name('orders.update');
});
