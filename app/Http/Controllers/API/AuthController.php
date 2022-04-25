<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response(['status'=> false,'message'=> $validator->errors()->first(), 'data' => $validator->errors()->all() ], 400);
        }
        $user = User::where('email', $request->email)->first();
        $response = [ 'status'=>true, 'message' => '','data' => NULL];
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('ASEANTECH2022')->accessToken;
                $response['data'] = [ 'token' => $token, 'user' => $user];
                $response['message'] = 'success login';
                return response($response, 200);
            } else {
                $response["status"] = false;
                $response["message"] = "Password mismatch";
                return response($response, 400);
            }
        } else {
            $response["status"] = false;
            $response["message"] = "User does not exist";
            return response($response, 400);
        }
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = [ 'status'=>true, 'message' => 'You have been successfully logged out!','data' => NULL];
        return response($response, 200);
    }

}
