<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileService
{
    public function showProfile(int $id)
    {
        $user = User::findOrFail($id);
        return [
            'user' => $user,
        ];
    }

    public function updateProfile(array $data, int $id) {

        $user = User::findOrFail($id);

        $fileName = $user->avatar ?? null;

        if (isset($data['avatar'])) {
            if ($fileName && Storage::disk('public')->exists("avatars/$fileName")) {
                Storage::disk('public')->delete("avatars/$fileName");
            }

            $fileName = Str::uuid() . '.' . $data['avatar']->getClientOriginalExtension();
            $filePath = $data['avatar']->storeAs('avatars', $fileName, 'public');
            session()->put('user_informations.avatar', $fileName);
        }

        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'avatar' => $fileName
        ]);

        session()->put('user_informations.username', $data['username']);
        session()->put('user_informations.email', $data['email']);
        
        return $user;
    }

    public function removeAvatar(int $id) {
        $user = User::findOrFail($id);

        if ($user->avatar && Storage::disk('public')->exists("avatars/{$user->avatar}")) {
            Storage::disk('public')->delete("avatars/{$user->avatar}");
        }

        $user->update([
            'avatar' => null
        ]);
        
        session()->put('user_informations.avatar', null);

        return $user;
    }

    public function changePassword(array $data, int $id) {
        $user = User::findOrFail($id);

        if (!Hash::check($data['old_password'], $user->password)) {
            throw new \Exception('Password lama salah!');
        }
    
        // Cegah penggunaan password baru yang sama dengan password lama
        if ($data['old_password'] === $data['new_password']) {
            throw new \Exception('Password baru tidak boleh sama dengan password lama!');
        }
    
        // Update password
        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
    
        return $user;
    }
}