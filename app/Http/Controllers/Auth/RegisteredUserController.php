<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterUserService;

class RegisteredUserController extends Controller
{
    protected $registerUserService;

    public function __construct(RegisterUserService $registerUserService)
    {
        $this->registerUserService = $registerUserService;
    }

    public function create()
    {
        return view('auth.register.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $this->registerUserService->registerUser($validated);

        return redirect()->route('verification.notice');
    }
}
