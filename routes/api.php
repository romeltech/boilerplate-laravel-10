<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\UserApiController;

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
// Route::post('/sanctumlogin', [UserApiController::class, 'login']);
// Route::get('/checkuser', [UserApiController::class, 'checkSanctumUser']);

/**
 * Accout routes
 */
Route::middleware('authkey')->prefix('account')->group(function () {
    // profile
    Route::get('/profile/{id}', [ProfileController::class, 'getProfileById'])->name('profile.get.by.id');
    Route::post('/profile/save', [ProfileController::class, 'saveProfile'])->name('profile.save');
});
