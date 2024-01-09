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

Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Admin routes
 */
Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => 'auth'], function () {

    // dashboard
    Route::get('/dashboard',function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    // users
    Route::group(['prefix'=>'users','as'=>'users.'], function () {

        Route::get('/',function () {
            return Inertia::render('Admin/Users/Users');
        })->name('index');

        Route::get('/paginated', [UserController::class, 'paginatedUsers'])->name('api.paginated');

        Route::get('/edit/{id}',function () {
            return Inertia::render('Admin/Users/EditUsers');
        })->name('edit');

        // api
        Route::get('/single/{id}', [UserController::class, 'userById'])->name('single.user');

    });
});

require __DIR__.'/auth.php';
