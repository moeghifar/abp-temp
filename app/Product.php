<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
        'product_name','supplier_id','price'
    ];

    public function supplier() 
    {
        return $this->belongsTo('App\Supplier');
    }
}
