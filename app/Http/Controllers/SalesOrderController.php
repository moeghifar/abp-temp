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
        $so['data'] = SalesOrder::orderBy('id', 'desc')->get();
        foreach($so['data'] as $i => $v) {
            $v->sales_order_id = $v->id;
            $v->sales_order_name = $v->sales_number;
            $v->price = $v->total_price;
            $v->customer_name = SalesOrder::find($v->id)->customer->customer_name;
        }
        return $so;
    }

    public function getById(SalesOrder $salesOrder, $id)
    {
        $salesOrderData = SalesOrder::find($id);
        $so['total'] = count($salesOrderData);
        if (count($salesOrderData) > 0) {
            $so['data']['sales_order_data'] = $salesOrderData;
            $getCustomer = SalesOrder::find($salesOrderData->id)->customer;
            $so['data']['sales_order_data']['customer_data'] = $getCustomer->customer_name;
            $getProduct = SalesOrder::find($salesOrderData ->id)->product;
            $buildProduct = array();
            if (count($getProduct) > 0) {
                foreach($getProduct as $i => $v) {
                    $buildProduct[$i]['product_name'] = $v->product_name;
                    $buildProduct[$i]['price'] = $v->price;
                    $buildProduct[$i]['qty'] = $v->pivot->qty;
                    $buildProduct[$i]['qty_price'] = $v->pivot->qty_price;
                }
            }
            $so['data']['product_data'] = $buildProduct;
        }
        return $so;
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
