<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use Auth;

class UserController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();
    	return fractal()
    		->collection($users)
    		->transformWith(new UserTransformer)
    		->toArray();
    }

    /*
		retrieve profile of logged in user using token authentication
    */
    public function profile(User $user)
    {
    	$userData = $user->find(Auth::user()->id);

    	return fractal()
    		->item($userData)
    		->transformWith(new UserTransformer)
    		->toArray();
    }	
}
