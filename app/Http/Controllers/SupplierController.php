<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use Auth;

class SupplierController extends Controller
{

    public function get(Supplier $supplier)
    {
    	$supplierResponse = $supplier->all();
    	return fractal()
    		->collection($supplierResponse)
    		->transformWith(new SupplierTransformer)
    		->toArray();
    }

    public function getById(Supplier $supplier, $id)
    {
    	$supplierResponse = $supplier->find($id);
    	return fractal()
    		->item($supplierResponse)
    		->transformWith(new SupplierTransformer)
    		->toArray();
    }

    public function add(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'supplier_name'     => 'required|min:3',
            'supplier_address'  => 'required|min:10',
            'supplier_phone'    => 'required|min:10|numeric',
        ]);
        $supplierResponse = $supplier->create([
            'supplier_name'		=> $request->supplier_name,
            'supplier_address'	=> $request->supplier_address,
            'supplier_phone'	=> $request->supplier_phone,
        ]);
        $response = fractal()
            ->item($supplierResponse)
            ->transformWith(new SupplierTransformer)
            ->toArray();
        return response()->json($response, 201);
    }
}
