<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientKeyController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PublicPageController;

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

// Route::get('/', [PageController::class, 'home'])->name('root');
Route::get('/', function () { return redirect()->route('admin'); });


/**
 * Error pages
 */
Route::get('/unauthorized', [PageController::class, 'home'])->name('unauthorized');


/**
 * Save Client Access
 */
Route::post('/client/savekey', [ClientKeyController::class, 'saveKey'])->name('client.key.save');
Route::post('/client/removekey', [ClientKeyController::class, 'removeKey'])->name('client.access.remove');

/**
 * Sanctum login
 */
Route::get('/access', [PublicPageController::class, 'access'])->name('sanctum.login');

/**
 * Admin routes
 */
Route::prefix('admin')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('admin');
    Route::get('/{slug}', [PageController::class, 'home'])->name('admin.slug');

    // users
    Route::get('/users/{id}', [PageController::class, 'home'])->name('admin.get.users');
    // users axios
    Route::get('/user/all', [UserController::class, 'getUsers'])->name('admin.get.all.users');
    Route::get('/user/single/{id}', [UserController::class, 'getSingleUser'])->name('admin.get.single.user');
});

/**
 * Normal routes
 */
Route::prefix('u')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('normal');
    Route::get('/{slug}', [PageController::class, 'home'])->name('normal.slug');
});

/**
 * Accout routes
 */
Route::prefix('account')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('account');
});

/**
 * Custom authentication
 */
Route::post('login', [CustomAuthController::class, 'login'])->name('custom.login');
