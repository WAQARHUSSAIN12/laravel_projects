<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $userAdd =  User::create($request->all());
        $response["token"] =  $userAdd->createToken('MyAuthApp')->plainTextToken;
        $response["name"] = $userAdd->name;
        
        return $response;

    }
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = new User();
            $response['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $response['name'] =  $authUser->name;
            $response['message'] =  'User signed in';
            return $response;
        } 
        else{ 
            return ['error'=>'Unauthorised'];
        } 

    }
}
