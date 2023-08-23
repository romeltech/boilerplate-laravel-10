<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:9',
        ]);
        $user = User::where('id', $request['user_id'])->update([
            'password' => Hash::make($request['password'])
        ]);
        return response()->json([
            'message' => "Password updated successfully"
        ], 200);
    }

    public function saveProfile(Request $request)
    {
        $profile = Profile::updateOrCreate(
            [
                'user_id' => $request['user_id']
            ],
            [
                'user_id' => $request['user_id'],
                'full_name' => $request['full_name'],
                'dob' => $request['dob'],
                'nationality' => $request['nationality'],
            ]
        );
        return response()->json([
            'message' => 'Profile updated successfully',
        ], 200);
    }

    public function saveUser(Request $request)
    {
        $user = new User;
        $check = $user->find($request['id']);
        $userArray = array(
            'status' => $request['status'],
            'role' => $request['role'],
            'username' => $request['username'],
            'email' => $request['email'],
            'phone_no' => $request['phone_no']
        );
        if($check){
            $user = $check;
            $check->update($userArray);
        }else{
            $user->create($userArray);
        }
        return response()->json([
            'message' => "User updated successfully",
            'user' => $user
        ], 200);
    }

    public function getSingleUser($id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return response()->json($user, 200);
    }

    public function getUsers()
    {
        $users = User::paginate(10);
        return response()->json($users, 200);
    }
}
