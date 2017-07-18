<?php

use Illuminate\Http\Request;

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

// Auth API
Route::post('v1/auth/register','AuthController@register');
Route::post('v1/auth/login','AuthController@login');

// User API
Route::get('v1/users','UserController@users');
Route::get('v1/users/profile','UserController@profile')->middleware('auth:api');

// Supplier API
Route::post('v1/supplier/add','SupplierController@add')->middleware('auth:api');
Route::put('v1/supplier/{supplier}','SupplierController@update')->middleware('auth:api');
Route::delete('v1/supplier/{supplier}','SupplierController@delete')->middleware('auth:api');
Route::get('v1/supplier/get','SupplierController@get')->middleware('auth:api');
Route::get('v1/supplier/{id}','SupplierController@getById')->middleware('auth:api');