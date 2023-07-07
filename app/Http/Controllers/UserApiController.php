<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserApiController extends Controller
{
    public function login(Request $request)
    {
        // Validate login
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where([
            'username' => $fields['username'],
            'status' => 'active'
        ])->with('teams')->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Incorrect login credentials'
            ], 401);
        }

        // Generate Token
        $token = $user->createToken('meluserstoken')->plainTextToken;

        $users = User::with('teams')->get();

        // Response
        $response = [
            'user' => $user,
            'usersss' => $users,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function checkSanctumUser(Request $request)
    {
        $hasToken = auth('sanctum')->check();
        return response()->json([
            "user" => auth('sanctum')->user(),
            "hasToken" => $hasToken
        ], 200);
    }


    /**
     * Below are unsued
     */
    public function logout(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string'
        ]);
        $user = User::where([
            'username' => $fields['username'],
            'status' => 'active'
        ])->first();

        if($user){
            $token = $user->tokens();
            $token->delete();
        }

        return response()->json([
            "user" => $user,
              // "token" => auth()->user()->tokens()
        ], 200);
    }

    public function getUser(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string'
        ]);
        $user = User::where([
            'username' => $fields['username'],
            'status' => 'active'
        ])->firstOrFail();

        // $hasToken = auth('sanctum')->check();

        if($user->tokens() != ""){
            $hasToken = true;
        }

        return response()->json([
            "user" => $user,
            "token" => $hasToken
        ], 200);
    }

    public function checkUser(Request $request)
    {
        $bearer = $request->bearerToken() ? $request->bearerToken() : null;
        $user = $request->user() ? $request->user() : null;
        $token = null;

        if(auth('sanctum')->check()){
            // check
            $checkToken = PersonalAccessToken::findToken($bearer);
            if($checkToken){
                $token = $bearer;
            }
        }else{
            return response()->json([
                'user' => $user,
                'bearer' => $bearer,
                'token' => $token
            ], 401);
        }

        return response()->json([
            'user' => $user,
            'bearer' => $bearer,
            'token' => $token,
            'check' => auth('sanctum')->check()
        ]);
    }

    public function refreshToken(Request $request)
    {
        $bearer = $request->bearerToken() ? $request->bearerToken() : null;
        $user = $request->user() ? $request->user() : null;
        $token = null;

        if(auth('sanctum')->check()){
            // delete tokens
            $deleteToken = $user->tokens()->delete();
            // generate a new token
            $token = $user->createToken('meluserstoken')->plainTextToken;
        }else{
            return response()->json([
                'user' => $user,
                'bearer' => $bearer,
                'token' => $token
            ], 401);
        }

        return response()->json([
            'user' => $user,
            'bearer' => $bearer,
            'token' => $token,
            'check' => auth('sanctum')->check()
        ]);
    }
}
