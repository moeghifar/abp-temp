<?php

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

Route::get('/', function () {
    return view('page/login');
});

Route::get('/home', function () {
    return view('page/home');
});

Route::get('/data/supplier/{supplier_id?}', function ($supplier_id = null) {
    if($supplier_id != null && !is_int($customer_id)) {
        return abort(404,"Wrong URI Path");
    }
    $params['supplier_id']      = $supplier_id;
    return view('page/data/supplier',$params);
});

Route::get('/data/customer/{customer_id?}', function ($customer_id = null) {
    if($customer_id != null && !is_int($customer_id)) {
        return abort(404,"Wrong URI Path");
    }
    $params['customer_id'] = $customer_id;
    return view('page/data/customer',$params);
});

Route::get('/data/product/{product_id?}', function ($product_id = null) {
    if($product_id != null && !is_int($product_id)) {
        return abort(404,"Wrong URI Path");  
    }
    $params['product_id'] = $product_id;
    return view('page/data/product',$params);
});

Route::get('/sales/order/{sales_order?}', function ($sales_order = null) {
    if($sales_order != null) {
        if(!is_int($sales_order)) {
            return abort(404,"Wrong URI Path");  
        } else {
            // temporary to 404 if number
            return abort(404,"Wrong URI Path");  
        }
    }
    $params['sales_order'] = $sales_order;
    return view('page/sales/order', $params);
});

Route::get('sales/order/test/debug','SalesOrderController@debug');

Route::get('/sales/invoice/{sales_invoice_id?}', function ($sales_invoice_id = null) {
    if($sales_invoice_id != null && !is_int($sales_invoice_id)) {
        return abort(404,"Wrong URI Path");  
    }
    $params['sales_invoice_id'] = $sales_invoice_id;
    return view('page/sales/invoice',$params);
});

Route::get('/sales/return/{sales_return_id?}', function ($sales_return_id = null) {
    if($sales_return_id != null && !is_int($sales_return_id)) {
        return abort(404,"Wrong URI Path");  
    }
    $params['sales_return_id'] = $sales_return_id;
    return view('page/sales/return',$params);
});

Route::get('/table/coa/', function () {
    $params[] = '';
    return view('page/table/coa',$params);
});