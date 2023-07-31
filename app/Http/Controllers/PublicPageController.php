<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function access()
    {
        return view('layouts.app');
    }
}
