<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $tokenRequest = Request::create('/oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => config('auth.passport_client_id'),
            'client_secret' => config('auth.passport_client_secret'),
            'username' => $request->email,
            'password' => $request->password,
        ]);

        $response = app()->handle($tokenRequest);

        if($response->getStatusCode() != 200){
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $data = json_decode($response->getContent(), true);

        return response()->json([
            'access_token' => $data['access_token'],
            'token_type' => 'Bearer',
            'expires_in' => $data['expires_in'],
        ]);
    }
}
