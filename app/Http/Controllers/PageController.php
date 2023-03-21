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
            // return Inertia::render('Admin/Dashboard');
            return redirect('/admin');
        }elseif($role == 'normal'){
            return redirect('/u');
        }
    }

    public function adminMainPages($page = null)
    {
        $page = ucfirst($page);
        return Inertia::render('Admin/'.$page);
    }
}
