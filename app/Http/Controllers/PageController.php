<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite

    /**
     * Dashboard
     */
    public function dashboard()
    {
        $role = Auth::user()->role;
        if($role === 'admin'){
            return redirect('/admin/dashboard');
        }elseif($role == 'normal'){
            return redirect('/u/dashboard');
        }else{
            return redirect('/u/dashboard');
        }
    }

    public function adminMainPages(Request $request, string $path)
    {
        $path = ucfirst($path);
        return Inertia::render('Admin/'.$path, [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
