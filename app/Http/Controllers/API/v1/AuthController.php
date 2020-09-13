<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use App\User;
use Validator;

class AuthController extends Controller
{ 
    public function login(Request $request)
    {
        $hasher = app('hash');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result'=>[
                    'error'=>true,'message'=>$validator->errors()->first()
                ]
            ], 401);
        } 
		  
        $user = User::Where('email',$request->email)->first();
        
		if(!$user){
            return response()->json([
                'result'=>[
                    'error'=>true,
                    'message'=>'Username or password invalid!'
                ]
            ], 401);
        }
        
        if (!$hasher->check($request->password, $user->password)) {
            return response()->json(['data'=>[
                'error'=>true,'message'=>'Username or password invalid!'
            ]]);
        }
        
        $user->generateToken();

        return response()->json([
            'result'=>[
                'error'=>false,
                'token'=>$user->api_token
            ]
        ]);
    }
	
		
}
