<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Account routes
 */
Route::middleware('auth')->group(function () {
    // account
    Route::get('/account', function () { return Inertia::render('Account/Account'); })->name('account');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Admin routes
 */
Route::middleware('auth')->prefix('admin')->group(function () {

    // main pages
    // Route::get('/{page?}', [PageController::class, 'adminMainPages'])->name('admin.main.pages');
    Route::get('/', function () { return Inertia::render('Admin/Dashboard'); })->name('admin.dashboard');

    /**
     * Users
     */
    Route::get('/users', function () { return Inertia::render('Admin/Users/Users'); })->name('admin.users');
    Route::get('/users/{id}', function () { return Inertia::render('Admin/Users/EditUser'); })->name('admin.edit.users');

    Route::get('/user/all', [UserController::class, 'getUsers'])->name('admin.get.all.users');
    Route::get('/user/single/{id}', [UserController::class, 'getSingleUser'])->name('admin.get.all.users');
    Route::get('/user/save', [UserController::class, 'saveUser'])->name('admin.save.user.account');
    Route::get('/user/profile/save', [UserController::class, 'saveProfile'])->name('admin.save.user.profile');

    Route::get('/companies', function () { return Inertia::render('Admin/Companies'); })->name('admin.companies');
    Route::get('/departments', function () { return Inertia::render('Admin/Departments'); })->name('admin.departments');
    Route::get('/logs', function () { return Inertia::render('Admin/Logs'); })->name('admin.logs');
});

/**
 * Employee routes
 */
Route::middleware('auth')->prefix('u')->group(function () {
    Route::get('/', function () { return Inertia::render('Normal/Dashboard'); })->name('u.dashboard');
    Route::get('/account', function () { return Inertia::render('Normal/Account'); })->name('u.account');
});

// Route::get('/test', function() {
//     return Auth::user();
// });

require __DIR__.'/auth.php';
