<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SalesInvoice;
use App\Customer;
use Validator;
use Auth;

class SalesInvoiceController extends Controller
{
    public function debug(SalesInvoice $salesInvoice, Customer $customer)
    {
        $so['total'] = SalesInvoice::count();
        $so['data'] = SalesInvoice::find(1);
        if ($so['data'] != null) {
            $customer_id = SalesInvoice::find($so['data']->id)->salesOrder->customer_id;
            $so['data']['customer'] = Customer::find($customer_id)->customer_name;
        }
        return $so;
    }

    public function get(SalesInvoice $salesInvoice)
    {
        $so['data'] = SalesInvoice::orderBy('id', 'desc')->get();
        foreach($so['data'] as $i => $v) {
            $customer_id = SalesInvoice::find($v->id)->salesOrder->customer_id;
            $v->sales_invoice_id = $v->id;
            $v->sales_invoice_name = $v->invoice_number;
            $v->customer_name = Customer::find($customer_id)->customer_name;
        }
        return $so;
    }

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
            $rsp = $salesInvoice->create([
                'invoice_number'    => $request->invoice_number,
                'sales_order_id'	=> $request->sales_order_id,
                'date'	            => $request->date
            ]);
            // update sales order status
            DB::table('sales_order')->where('id', $request->sales_order_id)->update(['status' => 2]);
            $response = $request;
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }
}
