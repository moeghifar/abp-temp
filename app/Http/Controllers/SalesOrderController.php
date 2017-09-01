<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use Validator;
use Auth;

class SalesOrderController extends Controller
{

    public function debug(SalesOrder $salesOrder)
    {
        $data['sales_order_id'] = null;
        $so['total'] = SalesOrder::count();
        $so['data'] = SalesOrder::all();
        foreach($so['data'] as $i => $v) {
            $v->customer_data = SalesOrder::find($v->id)->customer;
        }
        return $so;
    }

    public function get(SalesOrder $salesOrder)
    {
        $so['data'] = SalesOrder::all();
        foreach($so['data'] as $i => $v) {
            $v->price = $v->total_price;
            $v->customer_name = SalesOrder::find($v->id)->customer->customer_name;
        }
        return $so;
    	// $supplierResponse = $supplier->orderBy('id', 'desc')->get();
    	// return fractal()
    	// 	->collection($supplierResponse)
    	// 	->transformWith(new SupplierTransformer)
    	// 	->respond();
    }

    public function getById(Supplier $supplier, $id)
    {
    	$supplierResponse = $supplier->find($id);
    	return fractal()
    		->item($supplierResponse)
    		->transformWith(new SupplierTransformer)
    		->respond();
    }

    public function add(Request $request, SalesOrder $salesOrder)
    {
        $response = $request;
        $responseCode = 200;
        // $validator = Validator::make($request->all(), [
        //     'supplier_name'     => 'required|min:3',
        //     'supplier_address'  => 'required|min:10',
        //     'supplier_phone'    => 'required|min:10|numeric',
        // ]);
        // if ($validator->fails()) {
        //     $response = $validator->errors();
        //     $responseCode = 404;
        // } else {
        //     $supplierResponse = $supplier->create([
        //         'supplier_name'		=> $request->supplier_name,
        //         'supplier_address'	=> $request->supplier_address,
        //         'supplier_phone'	=> $request->supplier_phone,
        //     ]);
        //     $response = fractal()->item($supplierResponse)->transformWith(new SupplierTransformer)->toArray();
        //     $responseCode = 201;
        // }
        return response()->json($response, $responseCode);
    }

    public function update(Request $request, Supplier $supplier, $id)
    {
        $supplier = $supplier->find($id);
    	$validator = Validator::make($request->all(), [
    		'supplier_name' 	=> 'required|min:3',
    		'supplier_address' 	=> 'required|min:10',
    		'supplier_phone' 	=> 'required|min:10|numeric',
		]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            $supplier->supplier_name 	= $request->get('supplier_name', $supplier->supplier_name);
            $supplier->supplier_address = $request->get('supplier_address', $supplier->supplier_address);
            $supplier->supplier_phone 	= $request->get('supplier_phone', $supplier->supplier_phone);
            $supplier->save();
            $response = fractal()
                ->item($supplier)
                ->transformWith(new SupplierTransformer)
                ->toArray();
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function delete(Supplier $supplier, $id)
    {
    	$supplier->find($id)->delete();
    	return response()->json([
    		'message' => 'Data was deleted',
    	]);
    }
    
}
