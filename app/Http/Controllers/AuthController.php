<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthFieldsValidation;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthFieldsValidation $request){
        $user = User::create([
            "name"=>$request["name"],
            "email"=>$request["email"],
            "password"=>bcrypt($request["password"])
        ]);

        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [ 
            'user'=>$user,
            "token"=>$token
        ];

        return response($response,201);
    }

    
    public function login(LoginRequest $request){
        $user = User::where("email",$request['email'])->first();

        if (!$user || !Hash::check($request["password"], $user->password)) {
            return response([
                "message"=>"Unauthorized"
            ],401);
        };


        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [ 
            'user'=>$user,
            "token"=>$token
        ];

        return response($response,201);
    }


    public function Logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            "message"=>"Logged Out"
        ];

    }
}
