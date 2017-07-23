<?php

namespace App\Transformers;

use App\Customer;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{
    public function transform(Customer $customer)
    {
        return [
            'customer_id' 		=> $customer->id,
			'customer_name' 	=> $customer->customer_name,
			'customer_address' 	=> $customer->customer_address,
			'customer_phone' 	=> $customer->customer_phone,
			'created' 			=> $customer->created_at,
			'updated' 			=> $customer->updated_at,
        ];
    }
}
