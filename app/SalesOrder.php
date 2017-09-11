<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrder extends Model
{
    use SoftDeletes;
    protected $table = 'sales_order';
    protected $salesOrder = ['deleted_at'];
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
        'date','sales_number','customer_id','total_price'
    ];

    public function customer() 
    {
        return $this->belongsTo('App\Customer');
    }
    
    public function product()
    {
        return $this->belongsToMany('App\Product','sales_order_product')->withPivot('qty', 'qty_price');;
    }
}
