<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        $supplier_data = Product::find($product->id)->supplier;
        return [
            'product_id'    => $product->id,
            'product_name'  => $product->product_name,
            'supplier_id'   => $product->supplier_id,
            'supplier_name' => $supplier_data->supplier_name,
            'price'         => $product->price,
            'created'       => $product->created_at,
            'updated'       => $product->updated_at,
        ];
    }
}
