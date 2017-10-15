<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use Validator;
use Auth;

class PurchaseOrderController extends Controller
{
    function debug(Request $request) {
        $param = $request->param;
        return $param;
    }

    public function get(PurchaseOrder $purchaseOrder)
    {
        $po['data'] = PurchaseOrder::orderBy('id', 'desc')->get();
        foreach($po['data'] as $i => $v) {
            $v->purchase_order_id = $v->id;
            $v->purchase_order_name = $v->purchase_number;
            $v->price = $v->total_price;
            $v->supplier_name = PurchaseOrder::find($v->id)->supplier->supplier_name;
        }
        return $po;
    }

    public function getById(PurchaseOrder $purchaseOrder, $id)
    {
        $purchaseOrderData = PurchaseOrder::find($id);
        $so['total'] = count($purchaseOrderData);
        if (count($purchaseOrderData) > 0) {
            $so['data']['purchase_order_data'] = $purchaseOrderData;
            $getSupplier = PurchaseOrder::find($purchaseOrderData->id)->supplier;
            $so['data']['purchase_order_data']['supplier_data'] = $getSupplier->supplier_name;
            $getProduct = PurchaseOrder::find($purchaseOrderData ->id)->product;
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

    public function add(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validator = Validator::make($request->all(), [
            'purchase_number'   => 'required|min:3',
            'supplier_id'       => 'required|numeric',
            'date'              => 'required',
        ]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            // insert into sales order
            $rsp = $purchaseOrder->create([
                'purchase_number'	=> $request->purchase_number,
                'supplier_id'	    => $request->supplier_id,
                'date'	            => $request->date,
                'total_price'       => 0,
                'status'            => 1,
            ]);
            // get last insert id
            $insertID = DB::table('purchase_order')->max('id');
            // build multiple & create total 
            $multiInsert = array();
            $total = 0;
            foreach($request->input('multi') as  $i => $v){
                $multiInsert[$i]['purchase_order_id'] = $insertID;
                $multiInsert[$i]['product_id'] = $v['product_id'];
                $multiInsert[$i]['qty'] = $v['qty'];
                $multiInsert[$i]['qty_price'] = $v['qty_price'];
                $total = $total + $v['qty_price'];
            }
            // bulk insert into purchase_order_product
            DB::table('purchase_order_product')->insert($multiInsert);
            // update set total
            DB::table('purchase_order')->where('id', $insertID)->update(['total_price' => $total]);
            // response to fractal
            $response = $request;
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function delete(PurchaseOrder $purchaseOrder, $id)
    {
    	$purchaseOrder->find($id)->delete();
    	return response()->json([
    		'message' => 'Data was deleted',
    	]);
    }
}
