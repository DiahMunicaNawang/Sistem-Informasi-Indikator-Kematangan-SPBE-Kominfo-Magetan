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

    public function createUser() {
        $roles = Role::all();

        return [
            'roles' => $roles
        ];
    }

    public function storeUser(array $data) {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
            'email_verified_at' => now()
        ]);

        return $user;
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
        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $user->password,
            'role_id' => $data['role_id'],
            'email_verified_at' => $user->email_verified_at
        ]);
        return $user;
    }

    public function deleteUser(int $id) {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}