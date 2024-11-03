<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleService
{
    public function updateSessionMenus()
    {
        $user = Auth::user();

        // Mendapatkan daftar menu terbaru
        $updatedMenus = $user->role->menus->map(function ($menu) {
            return [
                'name' => $menu->name,
                'url' => $menu->url,
                'order' => $menu->order,
            ];
        })->toArray();

        // Update session
        session()->put('user_informations.menus', $updatedMenus);
    }
    
    public function getAllRoles()
    {
        
        // Eager load 'menus' untuk menghindari query N+1
        $data = Role::with('menus')->get();
        return $data;
    }

    public function createRole() {
        return Menu::all(); // Get all menus for dropdown
    }


    public function storeRole(array $data)
    {
        $name = Str::slug($data['name']);
        $role = Role::create(['name' => $name]);

        $role->menus()->attach($data['menus']);

        $this->updateSessionMenus();

        return $role;
    }

    public function editRole(Role $role) {
        $menus = Menu::all(); // Get all menus for dropdown
        $menuOld = $role->menus->pluck('id')->toArray(); // Get selected menus

        return [
            'role' => $role,
            'menus' => $menus,
            'menuOld' => $menuOld,
        ];
    }

    public function updateRole(Role $role, array $data)
    {
        $name = Str::slug($data['name']); // Convert URL to slug
        $role->update(['name' => $name]);
        
        $role->menus()->sync($data['menus']);
        
        $this->updateSessionMenus();

        return $role;
    }

    public function deleteRole(Role $role)
    {
        $role->menus()->detach(); // Hapus hubungan dengan menus sebelum menghapus role
        return $role->delete();
    }
}