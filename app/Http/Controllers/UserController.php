<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserController extends Controller
{
    public function saveProfile(Request $request)
    {
        $user = User::where('id', $id)->first();
        $user->profile()->update([
            'full_name' => $request['full_name'],
            'dob' => $request['dob'],
            'nationality' => $request['nationality'],
        ]);

        return response()->json([
            'message' => 'Profile updated successfully',
        ], 200);
    }

    public function saveUser(Request $request)
    {
        $user = User::where('id', $id)->update([

        ]);
        return response()->json($user, 200);
    }

    public function getSingleUser($id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return response()->json($user, 200);
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
