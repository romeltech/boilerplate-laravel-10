<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function paginatedUsers()
    {
        $users = User::with('profile')->paginate(20);
        return response()->json($users, 200);
    }

    public function userById(Request $request, $id): Response
    {
        $user = User::with('profile')->find($id);
        return Inertia::render('Admin/Users/EditUser', [
            'user' => $user,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
