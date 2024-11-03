<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'login' => ['required'],
            'password' => ['required']
        ]);

        $login = $credentials['login'];
        $user = User::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if ($user && Auth::attempt(['id' => $user->id, 'password' => $credentials['password']])) {
            if (!$user->hasVerifiedEmail()) {
                return redirect('/login')->with('warning', 'Silakan verifikasi email Anda terlebih dahulu.');
            }

            $request->session()->regenerate();
            $user_informations = Auth::user();
            // get all menus
            $menu_menus = $user_informations->role->menus->map(function ($menu) {
                return [
                    'name' => $menu->name,
                    'url' => $menu->url,
                    'order' => $menu->order,
                ];
            })->toArray();

            session([
                'user_informations' => [
                    'username' => $user_informations->username,
                    'email' => $user_informations->email,
                    'role' => $user_informations->role->name, // role is a relationship
                    'menus' => $menu_menus,
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
