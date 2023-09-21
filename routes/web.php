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
    'register' => false,
    'login' => false
]);

Route::get('/', [PageController::class, 'home'])->name('home');

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
Route::get('/check', [PublicPageController::class, 'access'])->name('sanctum.check');
// Route::get('/login', [PublicPageController::class, 'access'])->name('login');

/**
 * Admin routes
 */
Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'admin'])->name('admin');
    Route::get('/{slug}', [HomeController::class, 'admin'])->name('admin.slug');

    // users
    Route::get('/users/{id}', [PageController::class, 'home'])->name('admin.single.user');
    Route::get('/users/page/{page}', [PageController::class, 'home'])->name('admin.paginated.users');
    // users axios
    Route::get('/user/single/{id}', [UserController::class, 'getSingleUser'])->name('admin.get.single.user');
});

/**
 * Normal routes
 */
Route::prefix('u')->group(function () {
    Route::get('/', [HomeController::class, 'normal'])->name('normal');
    Route::get('/{slug}', [HomeController::class, 'normal'])->name('normal.slug');
});

/**
 * Accout routes
 */
Route::prefix('account')->group(function () {
    Route::post('/save', [UserController::class, 'saveUser'])->name('account.save.account');
    Route::post('/profile/save', [UserController::class, 'saveProfile'])->name('account.save.profile');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('account.change.password');
});

/**
 * Studio
 */
Route::prefix('studio')->group(function () {
    Route::post('/upload', [UserController::class, 'upload'])->name('studio.upload');
    Route::post('/upload-multiple', [UserController::class, 'uploadMultiple'])->name('studio.upload.multiple');
});


/**
 * Custom authentication
 */
Route::post('login', [CustomAuthController::class, 'login'])->name('custom.login');


/**
 * FCM Push Notifications
 */
Route::post('/fcm-token', [PageController::class, 'updateToken'])->name('fcmToken');
Route::post('/send-notification',[PageController::class,'notification'])->name('notification');
