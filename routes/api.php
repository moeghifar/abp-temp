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
Route::put('v1/supplier/{id}','SupplierController@update')->middleware('auth:api');
Route::delete('v1/supplier/{id}','SupplierController@delete')->middleware('auth:api');
Route::get('v1/supplier/get','SupplierController@get')->middleware('auth:api');
Route::get('v1/supplier/{id}','SupplierController@getById')->middleware('auth:api');

// Customer API
Route::post('v1/customer/add','CustomerController@add')->middleware('auth:api');
Route::put('v1/customer/{customer}','CustomerController@update')->middleware('auth:api');
Route::delete('v1/customer/{customer}','CustomerController@delete')->middleware('auth:api');
Route::get('v1/customer/get','CustomerController@get')->middleware('auth:api');
Route::get('v1/customer/{id}','CustomerController@getById')->middleware('auth:api');

// Product API
Route::post('v1/product/add','ProductController@add')->middleware('auth:api');
Route::put('v1/product/{product}','ProductController@update')->middleware('auth:api');
Route::delete('v1/product/{product}','ProductController@delete')->middleware('auth:api');
Route::get('v1/product/get','ProductController@get')->middleware('auth:api');
Route::get('v1/product/{id}','ProductController@getById')->middleware('auth:api');

// Cart of accounts API
Route::get('v1/table/coa/get','TableController@getCoa')->middleware('auth:api');

// Sales Order API
Route::post('v1/sales/order/add','SalesOrderController@add')->middleware('auth:api');
Route::delete('v1/sales/order/{id}','SalesOrderController@delete')->middleware('auth:api');
Route::get('v1/sales/order/get','SalesOrderController@get')->middleware('auth:api');
Route::get('v1/sales/order/get/status/{status}','SalesOrderController@getWithStatus')->middleware('auth:api');
Route::get('v1/sales/order/{id}','SalesOrderController@getById')->middleware('auth:api');

// Sales Invoice API
Route::post('v1/sales/invoice/add','SalesInvoiceController@add')->middleware('auth:api');
Route::delete('v1/sales/invoice/{id}','SalesInvoiceController@delete')->middleware('auth:api');
Route::get('v1/sales/invoice/get','SalesInvoiceController@get')->middleware('auth:api');
Route::get('v1/sales/invoice/{id}','SalesInvoiceController@getById')->middleware('auth:api');

// Sales Return API
Route::post('v1/sales/return/add','SalesReturnController@add')->middleware('auth:api');
Route::delete('v1/sales/return/{id}','SalesReturnController@delete')->middleware('auth:api');
Route::get('v1/sales/return/get','SalesReturnController@get')->middleware('auth:api');
Route::get('v1/sales/return/{id}','SalesReturnController@getById')->middleware('auth:api');

// Purchase Order API
Route::post('v1/purchase/order/add','PurchaseOrderController@add')->middleware('auth:api');
Route::delete('v1/purchase/order/{id}','PurchaseOrderController@delete')->middleware('auth:api');
Route::get('v1/purchase/order/get','PurchaseOrderController@get')->middleware('auth:api');
Route::get('v1/purchase/order/{id}','PurchaseOrderController@getById')->middleware('auth:api');

// Incoming Product API
Route::post('v1/incoming/product/add','IncomingProductController@add')->middleware('auth:api');
Route::delete('v1/incoming/product/{id}','IncomingProductController@delete')->middleware('auth:api');
Route::get('v1/incoming/product/get','IncomingProductController@get')->middleware('auth:api');
Route::get('v1/incoming/product/{id}','IncomingProductController@getById')->middleware('auth:api');

// Purchase Return API
Route::post('v1/purchase/return/add','PurchaseReturnController@add')->middleware('auth:api');
Route::delete('v1/purchase/return/{id}','PurchaseReturnController@delete')->middleware('auth:api');
Route::get('v1/purchase/return/get','PurchaseReturnController@get')->middleware('auth:api');
Route::get('v1/purchase/return/{id}','PurchaseReturnController@getById')->middleware('auth:api');