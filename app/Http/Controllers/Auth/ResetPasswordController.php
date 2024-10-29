<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Buat view ini
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['username' => 'required|exists:users,username']);

        $token = Str::random(60);
        $username = $request->username;

        // Simpan token ke dalam tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['username' => $username],
            ['token' => $token, 'created_at' => now()]
        );

        return redirect()->route('password.reset', ['token' => $token, 'username' => $username]);
    }

    public function showResetForm(Request $request, $token)
    {
        $username = $request->query('username');
        return view('auth.passwords.reset', compact('token', 'username')); // Pastikan untuk mengoper username
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        $username = $request->username;
        $token = $request->token;

        // Verifikasi token
        $resetToken = DB::table('password_reset_tokens')->where('username', $username)->first();

        if (!$resetToken || $resetToken->token !== $token) {
            return redirect()->back()->withErrors(['token' => 'This password reset token is invalid.']);
        }

        // Reset password
        $user = User::where('username', $username)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token setelah reset
        DB::table('password_reset_tokens')->where('username', $username)->delete();

        return redirect()->route('login')->with('status', 'Password has been reset successfully!');
    }
}
