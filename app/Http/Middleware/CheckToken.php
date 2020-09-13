<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle($request, Closure $next)
    {
        //get token via header
        $token = $request->header('Authorization');
        if(empty($token)){
            return response()->json([
                'code'=>'419',
                'error' => true,
                'message' => 'Authorization Header is empty'
            ]);
        }

        //format bearer token : 
        //Bearer[spasi]randomhashtoken 
        $split_token = explode(" ", $token);
        if(count($split_token) <> 2){
            return response()->json([
                'code'=>'419',
                'error' => true,
                'message' =>'Invalid Authorization format'
            ]);
        }

        if(trim($split_token[0]) <> 'Bearer'){
            return response()->json([
                'code'=>'419',
                'error' => true,
                'message' => 'Authorization header must be a Bearer'
            ]);
        }


        $access_token = trim($split_token[1]);

        //cek apakah access_token ini ada di database atau tidak
        $check = User::where('api_token', $access_token)->first();
        if(empty($check)){
            return response()->json([
                'code'=>'419',
                'error' => true,
                'message' => 'Forbidden : Invalid access token'
            ]);
        }

        //cek apakah access_token expired atau tidak
        // if(strtotime($cek->expired_at) < time() || $cek->is_active != 1){
        //     return response()->json([
        //         'error' => 'Forbidden : Token is already expired. '
        //     ]);
        // }

        //jika semua kondisi dipenuhi, lanjutkan request
        return $next($request);
    }
}