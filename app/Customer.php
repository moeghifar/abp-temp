<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // this protected variable called `$fillable` used to determine this supplier table can be inserted in batch mode
    protected $fillable = [
    	'customer_name', 'customer_address', 'customer_phone',
    ];
}
