<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 419);
        } 

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('AppName')->accessToken;

        return response()->json(['success' => $success ], $this->successStatus);
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
    {
        $user = Auth::user();
        $success['user'] = $user;

        $success['token'] = $user->createToken('AppName')->accessToken;
        return response()->json(['success' => $success ], $this->successStatus);
    }else{
        return response()->json(['errors' => 'Unauthorized'], 401);
    }
}

    public function getuser(){
        $user = Auth::user();
        
        return response()->json(['success' => $user ], $this->successStatus);
    }
}
