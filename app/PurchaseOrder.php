<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    protected $table = 'purchase_order';
    protected $salesInvoice = ['deleted_at'];
    protected $fillable = [
        // dont forget to fill this
        'date','purchase_number','supplier_id','total_price'
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product','purchase_order_product')->withPivot('qty', 'qty_price');
    }
}
