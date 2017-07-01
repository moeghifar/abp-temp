<?php
/*
	fielname 	: AuthController.php 
	author 		: @moeghifar | ghi.fai@gmail.com
	description : used to handle the authentication feature 
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Transformers\UserTransformer;

class AuthController extends Controller
{
	/*
		Function register used to register new user
		parameter `Request` = `$request` -> read value from http request (post/get) 
		parameter `User` = `$user` -> used as eloquent from user model
	*/
    public function register(Request $request, User $user ) 
    {
    	// validate input received from request (method either get / post)
    	$this->validate($request, [
    		'name' 		=> 'required',
    		'email' 	=> 'required|email|unique:users', // this is validate email & unique which read from tbl users
    		'password' 	=> 'required|min:6', 
		]);
    	// execute create / input data based on validated data 
    	$userResponse = $user->create([
    		'name'		=> $request->name,
    		'email'		=> $request->email,
    		'password'	=> bcrypt($request->password),
    		'api_token'	=> hash('whirlpool',$request->email), // api_token generated using email because its unique
		]);
    	// transform inserted user data and store to response variable 
    	$response = fractal()
    		->item($userResponse)
    		->transformWith(new UserTransformer)
    		->addMeta([
    			'token'	=> $userResponse->api_token,
    		])
    		->toArray();
    	// return output response with 201 status
    	return response()->json($response, 201);
    }

    /*
    	Function login used to authenticate login credential
		parameter `Request` = `$request` -> read value from http request (post/get) 
		parameter `User` = `$user` -> used as eloquent from user model
	*/
    public function login(Request $request, User $user)
    {
    	// check authentication with `Auth` function built in laravel
    	if(!Auth::attempt(['email' => $request->email,'password' => $request->password]))
    	{
    		// if auth error return wrong credentials message
    		return response()->json(['error' => 'Wrong credentials!'], 401);
    	}
    	// get data using eloquent `find()` which wrapped with `Auth`
    	$userResponse = $user->find(Auth::user()->id);
    	// transform result with fractal 
    	return fractal()
    		->item($userResponse)
    		->transformWith(new UserTransformer)
    		->addMeta([
    			'token'	=> $userResponse->api_token,
    		])->toArray();
    }
}
