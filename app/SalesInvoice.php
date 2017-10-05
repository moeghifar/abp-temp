<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoice extends Model
{
    use SoftDeletes;
    protected $table = 'sales_invoice';
    protected $salesInvoice = ['deleted_at'];
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
        'date','invoice_number','sales_order_id'
    ];

    // public function customer() 
    // {
    //     return $this->belongsTo('App\Customer');
    // }
    
    // public function product()
    // {
    //     return $this->belongsToMany('App\Product','sales_order_product')->withPivot('qty', 'qty_price');;
    // }
}
