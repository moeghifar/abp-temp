<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SalesOrder;
use Validator;
use Auth;

class SalesOrderController extends Controller
{

    public function debug(SalesOrder $salesOrder)
    {
        $so['total'] = SalesOrder::count();
        $so['data'] = SalesOrder::find(2);
        if ($so['data'] != null) {
            $so['data']['customer_data'] = SalesOrder::find($so['data']->id)->customer;
            $so['data']['product_data'] = SalesOrder::find($so['data']->id)->product;
        }
        return $so;
    }

    public function get(SalesOrder $salesOrder)
    {
        $so['data'] = SalesOrder::all();
        foreach($so['data'] as $i => $v) {
            $v->sales_order_id = $v->id;
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

    public function getById(SalesOrder $salesOrder, $id)
    {
    	$so['total'] = SalesOrder::count();
        $so['data'] = SalesOrder::find(2);
        if ($so['data'] != null) {
            $so['data']['customer_data'] = SalesOrder::find($so['data']->id)->customer;
            $so['data']['product_data'] = SalesOrder::find($so['data']->id)->product;
        }
        return $so;
    	// return fractal()
    	// 	->item($supplierResponse)
    	// 	->transformWith(new SupplierTransformer)
    	// 	->respond();
    }

    public function add(Request $request, SalesOrder $salesOrder)
    {
        $validator = Validator::make($request->all(), [
            'sales_number'      => 'required|min:3',
            'customer_id'       => 'required|numeric',
            'date'              => 'required',
        ]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            // insert into sales order
            $rsp = $salesOrder->create([
                'sales_number'	=> $request->sales_number,
                'customer_id'	=> $request->customer_id,
                'date'	        => $request->date,
                'total_price'   => 0,
            ]);
            // get last insert id
            $insertID = DB::table('sales_order')->max('id');
            // build multiple & create total 
            $multiInsert = array();
            $total = 0;
            foreach($request->input('multi') as  $i => $v){
                $multiInsert[$i]['sales_order_id'] = $insertID;
                $multiInsert[$i]['product_id'] = $v['product_id'];
                $multiInsert[$i]['qty'] = $v['qty'];
                $multiInsert[$i]['qty_price'] = $v['qty_price'];
                $total = $total + $v['qty_price'];
            }
            // bulk insert into sales_order_product
            DB::table('sales_order_product')->insert($multiInsert);
            // update set total
            DB::table('sales_order')->where('id', $insertID)->update(['total_price' => $total]);
            // response to fractal
            $response = $request;
            $responseCode = 201;
        }
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

    public function delete(SalesOrder $salesOrder, $id)
    {
    	$salesOrder->find($id)->delete();
    	return response()->json([
    		'message' => 'Data was deleted',
    	]);
    }
    
}
