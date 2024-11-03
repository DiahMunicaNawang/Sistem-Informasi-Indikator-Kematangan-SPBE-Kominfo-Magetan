<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserService
{
    public function getAllUsers() {
        return User::with('role')->orderBy('created_at', 'ASC')->get();
    }

    public function editUser(User $user) {
        $users = User::with('role')->get();
        $roles = Role::all();

        return [
            'user' => $user,
            'users' => $users,
            'roles' => $roles,
        ];
    }

    public function updateUser(User $user, array $data)
    {
        $user->update(['role_id' => $data['role_id']]);
        return $user;
    }

    public function deleteUser(User $user) {
        return $user->delete();
    }
}