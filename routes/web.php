<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// Main routes
Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Role
    // Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::resource('role', RoleController::class);

    // Menu
    // Route::get('menus', [MenuController::class, 'index'])->name('menus');
    Route::resource('menu', MenuController::class);

    // User
    // Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('user', UserController::class);

    // Manajemen Pengetahuan
    Route::view('manajemen-pengetahuan', 'manajemen-pengetahuan.index')->name('manajemen-pengetahuan');

    // Forum
    Route::resource('forum', UserController::class);

    // Articles
    Route::resource('article', ArtikelController::class);
});

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'authenticating'])
    ->name('authenticating');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// reset password

Route::get('/password/reset', [ResetPasswordController::class, 'toResetLinkForm'])
    ->name('password.resetLink');
Route::post('/password/email', [ResetPasswordController::class, 'sendResetEmailLink'])
    ->name('password.resetEmail');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

//verifikasi email
Route::get('/email/verify', function () {
    return view('auth.register.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('verify', 'Email Anda telah berhasil diverifikasi!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Email verifikasi baru telah dikirim.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Rating Article
Route::get('/article/article-rating', [ArtikelController::class, 'addRating'])->name('article.addRating');


// BATAS



// Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
//     ->name('password.reset');
// Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])
//     ->name('password.update');

// cadangan Route :

// Route::get('/password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])
//     ->name('password.request');
// Route::post('/password/reset', [ResetPasswordController::class, 'sendResetLink'])
//     ->name('password.email');
// Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
//     ->name('password.reset');
// Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])
//     ->name('password.update');
