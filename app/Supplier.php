<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    protected $suppliers = ['deleted_at'];
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
    	'supplier_name', 'supplier_address', 'supplier_phone',
    ];
}
