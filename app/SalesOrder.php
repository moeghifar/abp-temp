<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = 'sales_order';
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
        'date','sales_number','customer_id','total_price'
    ];

    // public function products()
    // {
    //     return $this->belongsToMany('App\Product','sales_order_product');
    // }

    public function customer() 
    {
        return $this->belongsTo('App\Customer');
    }
}
