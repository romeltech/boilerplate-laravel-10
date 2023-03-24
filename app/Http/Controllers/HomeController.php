<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $role = Auth::user()->role;
        if($role == 'admin' || $role == 'editor'){
            return redirect('admin');
        }elseif ($role === 'normal' ) {
            return redirect('dashboard');
        }
    }

    public function admin()
    {
        // return view('admin');
        return view('layouts.app');
    }

    public function normal()
    {
        return view('layouts.app');
    }
}
