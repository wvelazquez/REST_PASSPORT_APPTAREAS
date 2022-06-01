<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registro(Request $request){
        $validationInfo = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required:confirmed'
        ]);
        
        $validationInfo['password'] = Hash::make($request->password);
        $user = User::create($validationInfo);

        $accessToken = $user->createToken('authToken')->accessToken;

        return \response([
            'user' => $user,
            'access_token' => $accessToken
        ]);

    }

    public function loguin(Request $request){
        $loguinInfo = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        

        if(!auth()->attempt($loguinInfo)){
            return response(['message' => 'Datos invalidos']);

        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
        //dd($accessToken);
        return response(['user' => auth()->user(), 'token' => $accessToken]);

    }
}
