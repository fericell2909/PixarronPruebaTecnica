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

Route::group(['prefix' => 'dashboard'], function () {


    Route::group(['prefix' => 'user'], function () {

        Route::get('/{token}', 'DashBoardController@dashboard')->name('dashboard');

        Route::get('/perfil/{token}', 'DashBoardController@perfil')->name('dashboard.user.perfil');

        Route::get('/mis-ordenes/{token}', 'OrderController@index')->name('dashboard.user.misordenes');

        Route::get('/mis-direcciones/{token}', 'AddressController@index')->name('dashboard.user.misdirecciones');

    });

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/users/{token}', 'UserController@usuarios')->name('dashboard.admin.usuarios');

        Route::get('/mis-ordenes/{token}', 'OrderController@index')->name('dashboard.admin.misordenes');

        Route::get('/usuarios-direcciones/{token}', 'UserController@usuarios_direcciones')->name('dashboard.admin.users.direcciones');

        Route::get('/ordenes-usuario/{token}', 'OrderController@ordenes_usuario')->name('dashboard.admin.orders.user');

        Route::get('/productos/{token}', 'ItemController@index')->name('dashboard.admin.products');

    });


});
// fronEnd vue.js
Route::get('/{any}', 'ApplicationController')->where('any', '.*');

