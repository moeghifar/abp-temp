<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Transformers\ProductTransformer;
use Auth;
use Validator;

class ProductController extends Controller
{
    public function get(Product $product)
    {
    	$response = $product->orderBy('id', 'desc')->get();
    	return fractal()
    		->collection($response)
    		->transformWith(new ProductTransformer)
    		->respond();
    }

    public function getById(Product $product, $id)
    {
    	$response = $product->find($id);
    	return fractal()
    		->item($response)
    		->transformWith(new ProductTransformer)
    		->respond();
    }

    public function add(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name'      => 'required|min:3',
            'supplier_id'       => 'required|min:1|numeric',
            'price'             => 'required|min:3|numeric',
        ]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            $productResponse = $product->create([
                'product_name'	=> $request->product_name,
                'supplier_id'	=> $request->supplier_id,
                'price'	        => $request->price,
            ]);
            $response = fractal()->item($productResponse)->transformWith(new ProductTransformer)->toArray();
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function update(Request $request, Product $product)
    {
    	$validator = Validator::make($request->all(), [
    		'product_name'      => 'required|min:3',
            'supplier_id'       => 'required|min:1|numeric',
            'price'             => 'required|min:3|numeric',
		]);
        if ($validator->fails()) {
            $response = $validator->errors();
            $responseCode = 404;
        } else {
            $product->product_name 	= $request->get('product_name', $product->product_name);
            $product->supplier_id   = $request->get('supplier_id', $product->supplier_id);
            $product->price 	    = $request->get('price', $product->price);
            $product->save();
            $response = fractal()
                ->item($product)
                ->transformWith(new ProductTransformer)
                ->toArray();
            $responseCode = 201;
        }
        return response()->json($response, $responseCode);
    }

    public function delete(Product $product)
    {
    	$product->delete();
    	return response()->json([
    		'message' => 'Data was deleted',
    	]);
    }
}
