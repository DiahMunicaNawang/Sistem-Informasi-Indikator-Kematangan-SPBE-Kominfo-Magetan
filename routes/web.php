<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Article\ArtikelController;
use App\Http\Controllers\Forum\ForumCategoryController;
use App\Http\Controllers\Forum\ForumResponseController;
use App\Http\Controllers\Forum\ForumDiscussionController;
use App\Http\Controllers\IndikatorSPBE\IndikatorSPBEController;

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

    // Indikator SPBE
    Route::get('/indikator-spbe', [IndikatorSPBEController::class, 'index'])->name('indikator-spbe');

    // Articles
    Route::resource('article', ArtikelController::class)->where(['article' => '[0-9]+']);

    Route::prefix('article')->middleware('auth')->group(function () {
        // **Route Statis (Letakkan di atas untuk mencegah bentrok)**
        Route::get('/index_validate', [ArtikelController::class, 'validate_index'])
            ->name('article.validateIndex')
            ->middleware('article_role:super-admin|manajer-konten');

        Route::get('/create_category', [ArtikelController::class, 'createCategory'])
            ->name('article.createCategory')
            ->middleware('article_role:super-admin|manajer-konten');

        Route::post('/store_category', [ArtikelController::class, 'storeCategory'])
            ->name('article.storeCategory')
            ->middleware('article_role:super-admin|manajer-konten');

        // **Route Dinamis**
        Route::get('/{id}', [ArtikelController::class, 'show'])
            ->name('article.show')
            ->where('id', '[0-9]+'); // Membatasi parameter {id} hanya berupa angka

        // Route lainnya
        Route::get('/create', [ArtikelController::class, 'create'])
            ->name('article.create')
            ->middleware('article_role:super-admin|pengguna-terdaftar|manajer-konten');

        Route::post('/', [ArtikelController::class, 'store'])
            ->name('article.store')
            ->middleware('article_role:super-admin|pengguna-terdaftar|manajer-konten');

        Route::post('/store_rating', [ArtikelController::class, 'storeRating'])
            ->name('article.storeRating')
            ->middleware('article_role:super-admin|pengguna-terdaftar|manajer-konten');

        Route::get('/article/{id}/validate', [ArtikelController::class, 'validateArticle'])->name('article.validate')->middleware('article_role:super-admin|manajer-konten');

        Route::post('/article/{id}/validate', [ArtikelController::class, 'storeValidation'])->name('article.storeValidation')->middleware('article_role:super-admin|manajer-konten');

        Route::get('/article/print-pdf', [ArtikelController::class, 'printPDF'])->name('article.printPDF')->middleware('article_role:super-admin|manajer-konten|pengguna-terdaftar|pengguna-umum');

        Route::get('/article/check', [ArtikelController::class, 'checkArticle'])->name('article.checkArticle')->middleware('article_role:super-admin|manajer-konten|pengguna-terdaftar|pengguna-umum');
    });

    // Forum
    Route::resource('forum-category', ForumCategoryController::class);
    Route::resource('forum-discussion', ForumDiscussionController::class);
    Route::resource('forum-response', ForumResponseController::class);

    Route::get('forum-discussion-approval-user', [ForumDiscussionController::class, 'forum_discussion_approval_user'])->name('forum-discussion-approval-user');

    Route::get('forum-discussion-approval-process', [ForumDiscussionController::class, 'forum_discussion_approval_process'])->name('forum-discussion-approval-process');

    Route::get('forum-discussion-approval-reject/{id}', [ForumDiscussionController::class, 'forum_discussion_approval_reject'])->name('forum-discussion-approval-reject');

    Route::get('forum-discussion-approval-rejected', [ForumDiscussionController::class, 'forum_discussion_approval_rejected'])->name('forum-discussion-approval-rejected');

    Route::get('forum-discussion-approval-accept/{id}', [ForumDiscussionController::class, 'forum_discussion_approval_accept'])->name('forum-discussion-approval-accept');

    Route::post('forum-discussion-approval-accept-availability/{id}', [ForumDiscussionController::class, 'forum_discussion_approval_accept_availability'])->name('forum-discussion-approval-accept-availability');

    Route::get('forum-discussion-approval-accepted', [ForumDiscussionController::class, 'forum_discussion_approval_accepted'])->name('forum-discussion-approval-accepted');

    Route::get('forum-discussion-approval-destroy', [ForumDiscussionController::class, 'forum_discussion_approval_destroy'])->name('forum-discussion-approval-destroy');

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


Route::get('/test-email', function () {
    try {
        Mail::to('gangbeats89@gmail.com')->send(new \App\Mail\ArticleValidationNotification(
            'Judul Artikel',
            'published',
            'Komentar tambahan'
        ));
        return 'Email terkirim!';
    } catch (\Exception $e) {
        return 'Gagal mengirim email: ' . $e->getMessage();
    }
});

// Route::post('/upload-image', function (Request $request) {
//     if ($request->hasFile('upload')) {
//         $image = $request->file('upload');
//         $path = $image->store('images', 'public');

//         // Menggunakan asset langsung ke storage
//         return response()->json([
//             'url' => asset('storage/' . $path)
//         ]);
//     }
//     return response()->json(['error' => 'Image upload failed'], 400);
// });


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
