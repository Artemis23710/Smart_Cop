<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        $this->validate($request,[
            'email' => 'required|max:255',
            'password' => 'required'
        ]);

        $login = $request->only('email','password');
        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid login Details'],401);
        }

        /**
         * @var User $user
        */

        $user = Auth::user();

        $user->load('role');

        $token = $user->createToken('Personal Access Token');

        return response([
            'id' =>$user->id,
            'name' =>$user->name,
            'email' =>$user->email,
            'emp_id' =>$user->emp_id,
            'role_id' =>$user->role_id,
            'role_name' => $user->role->name,
           'token' => $token->plainTextToken
        ],200);
    }

    public function logout(Request $request)
    {
        /**
         * @var user $user
         */
        $user = Auth::user();

        if ($user) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });

            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    
        return response()->json(['message' => 'No user authenticated'], 400);
    }
}
