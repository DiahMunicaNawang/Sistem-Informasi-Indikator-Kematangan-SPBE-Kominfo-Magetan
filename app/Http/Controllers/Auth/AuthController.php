<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user_informations = Auth::user();
            session([
                'user_informations' => [
                    'username' => $user_informations->username,
                    'email' => $user_informations->email,
                    'role' => $user_informations->role,
                ]
            ]);

            return redirect()->intended('/');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'SALAH BRO');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
