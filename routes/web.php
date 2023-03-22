<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailerController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/', [PageController::class, 'dashboard'])->name('dashboard'); 
 
    // account
    Route::get('/account', function () { return Inertia::render('Account/Account'); })->name('account');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

/**
 * Admin routes
 */
Route::prefix('d')->group(function () {

    // main pages
    // Route::get('/{page?}', [PageController::class, 'adminMainPages'])->name('admin.main.pages');
    Route::get('/dashboard', function () { return Inertia::render('Admin/Dashboard'); })->name('admin.dashboard');
    Route::get('/emailers', function () { return Inertia::render('Admin/Emailers/Emailers'); })->name('admin.emailers');

    Route::get('/emailers/{id}', function () { return Inertia::render('Admin/Emailers/EditEmailer'); })->name('admin.edit.emailers'); 
   

    Route::get('/companies', function () { return Inertia::render('Admin/Companies'); })->name('admin.companies');
    Route::get('/departments', function () { return Inertia::render('Admin/Departments'); })->name('admin.departments');
    Route::get('/logs', function () { return Inertia::render('Admin/Logs'); })->name('admin.logs');
    Route::get('/account', function () { return Inertia::render('Normal/Account'); })->name('u.account');
   
}); 

Route::prefix('api')->group(function () {

    Route::get('/emailers/all', [EmailerController::class, 'getEmailers'])->name('admin.fetch.all.emailers');
    Route::get('/emailers/single/{id}', [EmailerController::class, 'getSingleEmailer'])->name('admin.get.all.emailers');

    Route::post('/user/profile/save', [UserController::class, 'saveProfile'])->name('user.save.profile');
    Route::post('/user/save', [UserController::class, 'saveUser'])->name('user.save.account');
    Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('user.change.password');
});
require __DIR__.'/auth.php';
