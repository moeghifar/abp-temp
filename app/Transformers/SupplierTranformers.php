<?php 

namespace App\Transformers;

use App\Supplier;
use League\Fractal\TransformerAbstract;

class SupplierTransformer extends TransformerAbstract 
{
	public function transform(Supplier $supplier)
	{
		return [
			'supplier_id' 		=> $supplier->id,
			'supplier_name' 	=> $supplier->supplier_name,
			'supplier_address' 	=> $supplier->supplier_address,
			'supplier_phone' 	=> $supplier->supplier_phone,
			'created' 			=> $supplier->created_at,
			'updated' 			=> $supplier->updated_at,
		];
	}
}