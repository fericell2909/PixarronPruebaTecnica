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

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::post('cart/increment/{uuid}','CartController@increment');
    Route::post('cart/decrement/{uuid}','CartController@decrement');
    Route::post('cart/deletecartitem/{uuid}','CartController@deletecartitem');
    Route::post('cart/addcartitem/{uuid}','CartController@addcartitem');
    Route::get('cart/getItems/{uuid}','CartController@getItems');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('order/{uuid}', 'OrderController@register_order');


    });
});

Route::get('/items','ItemController@paginate');

Route::get('/address/{uuid}','AddressController@address_user');

Route::post('/posts','PostController@paginate');
