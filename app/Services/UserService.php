<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserService
{
    public function getAllUsers() {
        $users = User::with('role')->orderBy('created_at', 'ASC')->get();
        return [
            'users' => $users
        ];
    }

    public function editUser(int $id) {
        $user = User::findOrFail($id);
        $users = User::with('role')->get();
        $roles = Role::all();

        return [
            'user' => $user,
            'users' => $users,
            'roles' => $roles,
        ];
    }

    public function updateUser(array $data, int $id)
    {
        $user = User::findOrFail($id);
        $user->update(['role_id' => $data['role_id']]);
        return $user;
    }

    public function deleteUser(int $id) {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}