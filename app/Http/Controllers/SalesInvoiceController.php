<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SalesInvoice;
use Validator;
use Auth;

class SalesInvoiceController extends Controller
{
    public function add(Request $request, SalesInvoice $salesInvoice)
    {
        $validator = Validator::make($request->all(), [
            'invoice_number'    => 'required|min:3',
            'sales_order_id'    => 'required|numeric',
            'date'              => 'required',
        ]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            // insert into sales order
            $rsp = $salesInvoice->create([
                'invoice_number'    => $request->invoice_number,
                'sales_order_id'	=> $request->sales_order_id,
                'date'	            => $request->date
            ]);
            // get last insert id
            // $insertID = DB::table('sales_order')->max('id');
            // build multiple & create total 
            // $multiInsert = array();
            // $total = 0;
            // foreach($request->input('multi') as  $i => $v){
            //     $multiInsert[$i]['sales_order_id'] = $insertID;
            //     $multiInsert[$i]['product_id'] = $v['product_id'];
            //     $multiInsert[$i]['qty'] = $v['qty'];
            //     $multiInsert[$i]['qty_price'] = $v['qty_price'];
            //     $total = $total + $v['qty_price'];
            // }
            // bulk insert into sales_order_product
            // DB::table('sales_order_product')->insert($multiInsert);
            // update set total
            // DB::table('sales_order')->where('id', $insertID)->update(['total_price' => $total]);
            // response to fractal
            $response = $request;
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }
}
