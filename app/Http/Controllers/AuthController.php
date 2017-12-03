<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

//jwt auth
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function signup(Request $request){

        $this->validate($request,[
            'name'  =>  'required',
            'username'  =>  'required|unique:users',
            'email'  =>  'required|unique:users',
            'password'  =>  'required',
        ]);

        return User::create([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

    }

    public function signin(Request $request){
        $this->validate($request,[

            'username'  =>  'required',
            'password'  =>  'required',
        ]);


        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));

    }
}
