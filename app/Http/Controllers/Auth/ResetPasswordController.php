<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function toResetLinkForm()
    {
        return view('auth.reset-password.new-password'); // Buat view ini
    }

    public function sendResetEmailLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirim email reset password
        $response = Password::sendResetLink($request->only('email'));

        return $response === Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'token' => 'required',
        ]);

        $credentials = $request->only('email', 'password', 'token');

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }
}

// cadangan :

// public function showLinkRequestForm()
//     {
//         return view('auth.reset-password.new-password'); // Buat view ini
//     }

//     public function sendResetLink(Request $request)
//     {
//         $request->validate(['username' => 'required|exists:users,username']);

//         $token = Str::random(60);
//         $username = $request->username;

//         // Simpan token ke dalam tabel password_reset_tokens
//         DB::table('password_reset_tokens')->updateOrInsert(
//             ['username' => $username],
//             ['token' => $token, 'created_at' => now()]
//         );

//         return redirect()->route('password.reset', ['token' => $token, 'username' => $username]);
//     }

//     public function showResetForm(Request $request, $token)
//     {
//         $username = $request->query('username');
//         return view('auth.reset-password.reset-password', compact('token', 'username')); // Pastikan untuk mengoper username
//     }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|exists:users,username',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     $username = $request->username;
    //     $token = $request->token;

    //     // Verifikasi token
    //     $resetToken = DB::table('password_reset_tokens')->where('username', $username)->first();

    //     if (!$resetToken || $resetToken->token !== $token) {
    //         return redirect()->back()->withErrors(['token' => 'This password reset token is invalid.']);
    //     }

    //     // Reset password
    //     $user = User::where('username', $username)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Hapus token setelah reset
    //     DB::table('password_reset_tokens')->where('username', $username)->delete();

    //     return redirect()->route('login')->with('status', 'Password has been reset successfully!');
    // }
