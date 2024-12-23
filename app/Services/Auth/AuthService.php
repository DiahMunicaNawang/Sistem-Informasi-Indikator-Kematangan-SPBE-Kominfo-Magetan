<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function validateLogin($login, $password)
    {
        $user = User::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if (!$user || !Auth::attempt(['id' => $user->id, 'password' => $password])) {
            return [
                'success' => false,
                'message' => 'Username atau Password salah'
            ];
        }

        if (!$user->hasVerifiedEmail()) {
            return [
                'success' => false,
                'message' => 'Silakan verifikasi email Anda terlebih dahulu.'
            ];
        }

        session([
            'user_informations' => [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role->name,
                'avatar' => $user->avatar
            ]
        ]);

        return ['success' => true];
    }
}