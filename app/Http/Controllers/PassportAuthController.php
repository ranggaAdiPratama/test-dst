<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:8',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
 
        if(auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

            return response()->json(['access_token' => $token, 'message' => 'Succesfully login'], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    { 
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        } else {
            Auth::user()->token()->revoke();
        }

        return response()->json(['message' => 'Succesfully logout'], 202);
    }
}
