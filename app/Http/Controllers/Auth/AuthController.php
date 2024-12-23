<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authenticating(Request $request)
    {
        $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);

        $result = $this->authService->validateLogin(
            $request->login,
            $request->password
        );

        if (!$result['success']) {
            return redirect('/login')->with('status', $result['message']);
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
