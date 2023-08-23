<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/sanctumlogin', [UserApiController::class, 'login']);
Route::post('/sanctumlogout', [UserApiController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/checkuser', [UserApiController::class, 'sanctumCheckUser']);

/**
 * Loggedin Routes
 */
Route::middleware('auth:sanctum')->group(function () {
    // Account
    Route::prefix('account')->group(function () {
        // save
        Route::post('/save', [UserController::class, 'saveUser'])->name('account.save');
        // profile
        Route::get('/profile/{id}', [ProfileController::class, 'getProfileById'])->name('profile.get.by.id');
        Route::post('/profile/save', [ProfileController::class, 'saveProfile'])->name('profile.save');
    });

    /**
     * Users
     */
    Route::prefix('user')->group(function () {
        Route::get('/all', [UserController::class, 'getUsers'])->name('admin.get.all.users');
    });
});


