<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleService
{
    public function getAllRoles()
    {
        
        // Eager load 'menus' untuk menghindari query N+1
        $roles = Role::with('menus')->get();
        return [
            'roles' => $roles,
        ];
    }

    public function createRole() {
        $menus = Menu::all(); // Get all menus for dropdown
        
        return [
            'menus' => $menus
        ];
    }


    public function storeRole(array $data)
    {
        $name = Str::slug($data['name']);
        $role = Role::create(['name' => $name]);

        return $role;
    }

    public function editRole(int $id) {
        $role = Role::findOrFail($id);

        return [
            'role' => $role,
        ];
    }

    public function updateRole(array $data, int $id)
    {
        $role = Role::findOrFail($id);
        $name = Str::slug($data['name']); // Convert URL to slug

        $role->update(['name' => $name]);

        return $role;
    }

    public function deleteRole(int $id)
    {
        $role = Role::findOrFail($id);
        return $role->delete();
    }
}