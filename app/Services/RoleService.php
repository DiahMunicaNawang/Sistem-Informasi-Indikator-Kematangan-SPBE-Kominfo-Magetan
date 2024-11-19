<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RoleService
{
    // public function updateCacheMenus()
    // {
    //     $role = Auth::user()->role;
    //     // Mendapatkan daftar menu terbaru sesuai role
    //     $updatedMenus = $role->menus()->get();

    //     // Hapus cache lama untuk menu
    //     Cache::forget('user_' . Auth::id() . '_menus');
    //     // Update cache
    //     Cache::put('user_' . Auth::id() . '_menus', $updatedMenus, now()->addMinutes(30));
    // }
    
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

        $role->menus()->attach($data['menus']);

        // $this->updateCacheMenus();

        return $role;
    }

    public function editRole(int $id) {
        $role = Role::findOrFail($id);
        $menus = Menu::all(); // Get all menus for dropdown
        $menuOld = $role->menus->pluck('id')->toArray(); // Get selected menus

        return [
            'role' => $role,
            'menus' => $menus,
            'menuOld' => $menuOld,
        ];
    }

    public function updateRole(array $data, int $id)
    {
        $role = Role::findOrFail($id);
        $name = Str::slug($data['name']); // Convert URL to slug

        $role->update(['name' => $name]);
        
        $role->menus()->sync($data['menus']);
        
        // $this->updateCacheMenus();

        return $role;
    }

    public function deleteRole(int $id)
    {
        $role = Role::findOrFail($id);
        $role->menus()->detach(); // Hapus hubungan dengan menus sebelum menghapus role
        return $role->delete();
    }
}