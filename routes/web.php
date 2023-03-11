<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Auth::routes();
Auth::routes([
    'register' => false
]); 
// Route::get('/', function () { return view('home'); });
Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('root');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'normal'])->name('normal');

/**
 * Custom authentication
 */
Route::post('login', [CustomAuthController::class, 'login'])->name('custom.login');