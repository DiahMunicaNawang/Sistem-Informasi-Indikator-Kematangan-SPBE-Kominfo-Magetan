<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', [DashboardController::class, 'index'])->middleware('auth', 'verified');

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
