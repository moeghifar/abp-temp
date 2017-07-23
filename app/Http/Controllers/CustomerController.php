<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Customer;
use App\Transformers\CustomerTransformer;
use Auth;

class CustomerController extends Controller
{
    public function get(Customer $customer)
    {
    	$response = $customer->orderBy('id', 'desc')->get();
    	return fractal()
    		->collection($response)
    		->transformWith(new CustomerTransformer)
    		->respond();
    }

    public function getById(Customer $customer, $id)
    {
    	$response = $customer->find($id);
    	return fractal()
    		->item($response)
    		->transformWith(new CustomerTransformer)
    		->respond();
    }

    public function add(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'     => 'required|min:3',
            'customer_address'  => 'required|min:10',
            'customer_phone'    => 'required|min:10|numeric',
        ]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            $CustomerResponse = $customer->create([
                'customer_name'		=> $request->customer_name,
                'customer_address'	=> $request->customer_address,
                'customer_phone'	=> $request->customer_phone,
            ]);
            $response = fractal()->item($customerResponse)->transformWith(new CustomerTransformer)->toArray();
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function update(Request $request, Customer $customer)
    {
    	$validator = Validator::make($request->all(), [
    		'customer_name' 	=> 'required|min:3',
    		'customer_address' 	=> 'required|min:10',
    		'customer_phone' 	=> 'required|min:10|numeric',
		]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            $customer->customer_name 	= $request->get('customer_name', $customer->customer_name);
            $customer->customer_address = $request->get('customer_address', $customer->customer_address);
            $customer->customer_phone 	= $request->get('customer_phone', $customer->customer_phone);
            $customer->save();
            $response = fractal()
                ->item($customer)
                ->transformWith(new CustomerTransformer)
                ->toArray();
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function delete(Customer $customer)
    {
    	$customer->delete();
    	return response()->json([
    		'message' => 'Data was deleted',
    	]);
    }
}
