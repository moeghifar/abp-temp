<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
    	'supplier_name', 'supplier_address', 'supplier_phone',
    ];
}
