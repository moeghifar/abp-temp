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

Route::get('/sales/order/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/sales/order';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/sales/invoice/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/sales/invoice';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/sales/return/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/sales/return';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/purchase/order/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/purchase/order';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/purchase/incoming/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/purchase/incoming';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/accounting/asset/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/accounting/asset';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/accounting/balance/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/accounting/balance';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/accounting/customers_accounts/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/accounting/customers_accounts';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/accounting/suppliers_accounts/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/accounting/suppliers_accounts';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/accounting/journal/{page?}/{id?}', function ($page = null, $id = null) {
    $view = 'page/accounting/journal';
    if($page == null) {
        return abort(404,"Wrong URI Path"); 
    }
    if($id != null) {
        if(!is_numeric($id)){
            return abort(404,"Wrong URI Path"); 
        }
    }
    $params['page'] = $page;
    $params['id'] = $id;
    return view($view, $params);
});

Route::get('/table/coa/', function () {
    $params[] = '';
    return view('page/table/coa',$params);
});



Route::get('sales/invoice.debug','SalesInvoiceController@debug');

Route::get('purchase/debug','PurchaseOrderController@debug');