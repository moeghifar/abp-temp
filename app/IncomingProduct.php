<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingProduct extends Model
{
    use SoftDeletes;
    protected $table = 'incoming_product';
    protected $salesInvoice = ['deleted_at'];
    protected $fillable = [
        // dont forget to fill this
    ];
}
