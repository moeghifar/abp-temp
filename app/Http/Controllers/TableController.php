<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    //
    public function getCoa() {
        $response = array( 'data' => DB::table('cart_of_accounts')->get());
        $responseCode = 200;
        return response()->json($response, $responseCode);
    }
}
