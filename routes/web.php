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
    return view('welcome');
});

Route::get('/home', function () {
    return view('page/home');
});

Route::get('/data/product/{action?}/{product_id?}', function ($action = null, $product_id = null) {
    $availableAction = array('edit','view');
    switch($action) {
        case 'view' :  
            break;
        case 'edit' : 
            if($product_id == null){
                return abort(404, "Wrong URI Path");
            }
            break;
        default :
            if ($action == null) {
                return redirect('/data/product/view');
            } else {
                return abort(404, "Wrong URI Path");
            }
    }
    $params['action']       = $action;
    $params['product_id']   = $product_id;
    return view('page/data/product',$params);
});

Route::get('/data/supplier/{action?}/{supplier_id?}', function ($action = null, $supplier_id = null) {
    switch($action) {
        case 'view' :  
            break;
        default :
            if ($action == null) {
                return redirect('/data/supplier/view');
            } else {
                return abort(404, "Wrong URI Path");
            }
    }
    $params['action']           = $action;
    $params['supplier_id']      = $supplier_id;
    return view('page/data/supplier',$params);
});

Route::get('/sales/order/{action?}/{sales_order_id?}', function ($action = null, $sales_order_id = null) {
    if ($action == null ) {
        return redirect('sales/order/view');
    }
    $params['action']       = $action;
    $params['sales_order_id']   = $sales_order_id;
    return view('page/sales/order',$params);
});
