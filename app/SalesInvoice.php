<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoice extends Model
{
    use SoftDeletes;
    protected $table = 'sales_invoice';
    protected $salesInvoice = ['deleted_at'];
    protected $fillable = [
        'date','invoice_number','sales_order_id'
    ];

    public function salesOrder() 
    {
        return $this->belongsTo('App\SalesOrder');
    }

    public function customer() 
    {
        return $this->belongsTo('App\Customer');
    }
    
    // public function product()
    // {
    //     return $this->belongsToMany('App\Product','sales_order_product')->withPivot('qty', 'qty_price');;
    // }
}
