<?php

namespace App\Services\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    public function registerUser($userData)
    {
        $userRole = Role::where('name', 'pengguna-umum')->first();
        
        $user = User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'role_id' => $userRole->id,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }
}