<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseReturn extends Model
{
    use SoftDeletes;
    protected $table = 'purchase_return';
    protected $salesInvoice = ['deleted_at'];
    protected $fillable = [
        // dont forget to fill this
    ];
}
