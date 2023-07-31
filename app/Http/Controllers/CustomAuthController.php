<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required_without:username|string|email|exists:users,email',
            'username' => 'required_without:email|string|exists:users,username',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(Auth::attempt( array( $fieldType => $input['username'], 'password' => $input['password'], 'status' => 'active'))){
            $user = Auth::user();
            // $isLoggedIn = Auth::loginUsingId($user->id);
            if($user->role === 'admin'){
                // return redirect()->route('admin');
                // return redirect('/admin');
                // return redirect('admin');
                return response()->json([
                    'user' => $user,
                    'login_status' => true,
                    'message' => 'Login successful'
                ], 200);
            }elseif($user->role === 'normal'){
                // return redirect('/u');
                return response()->json([
                    'user' => $user,
                    'login_status' => true,
                    'message' => 'Login successful'
                ], 200);
            }else{
                // return redirect('/u');
                return response()->json([
                    'user' => $user,
                    'login_status' => true,
                    'message' => 'Login successful'
                ], 200);
            }
        }else{
            return response()->json([
                'login_status' => false,
                'message' => 'Invalid login credentials'
            ], 403);
        }
    }
}
