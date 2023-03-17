<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserController extends Controller
{
    public function saveUser(Request $request)
    {
        dd($request);
        $user = User::where('id', $id)->update([

        ]);
        return response()->json($user, 200);
    }

    public function getSingleUsers($id)
    {
        $user = User::where('id', $id)->first();
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
