<?php

namespace App\Services;

use App\Models\User;
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
}