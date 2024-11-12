<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MenuService
{
    public function updateCacheMenus()
    {
        $role = Auth::user()->role;
        // Mendapatkan daftar menu terbaru sesuai role
        $updatedMenus = $role->menus()->get();

        // Hapus cache lama untuk menu
        Cache::forget('user_' . Auth::id() . '_menus');
        // Update cache
        Cache::put('user_' . Auth::id() . '_menus', $updatedMenus, now()->addMinutes(30));
    }

    public function getAllMenus()
    {
        // Eager load 'roles' untuk menghindari query N+1
        return Menu::with('roles')->get();
    }

    public function createMenu() {
        $roles = Role::all();
        $menus = Menu::all();
        $categories = Menu::where('is_category', true)->get();
    
        $dropdownOptions = [];
        foreach ($categories as $category) {
            $dropdownOptions[$category->id] = Menu::where('category_id', $category->id)
                ->where('url', null)
                ->where('dropdown_id', null)
                ->where('is_category', false)
                ->get(['id', 'name']);
        }
    
        return [
            'roles' => $roles,
            'menus' => $menus,
            'categories' => $categories,
            'dropdownOptions' => $dropdownOptions
        ];
    }
    
    public function storeMenu(array $data)
    {
        $menuData = [
            'name' => $data['name'],
            'is_category' => $data['type'] === 'category',
            'url' => $data['type'] === 'menu' ? '/' . Str::slug($data['url']) : null,
            'category_id' => in_array($data['type'], ['menu', 'dropdown']) ? $data['category_id'] : null,
            'dropdown_id' => $data['type'] === 'menu' ? ($data['dropdown_id'] ?? null) : null
        ];

        $menu = Menu::create($menuData);
        $menu->roles()->attach($data['roles']);
        
        $this->updateCacheMenus();
        return $menu;
    }
    
    public function editMenu(Menu $menu) 
    {
        $roles = Role::all();
        $roleOld = $menu->roles->pluck('id')->toArray();
        $menus = Menu::all();
        $categories = Menu::where('is_category', true)->get();

        // Determine menu type
        $menuType = 'menu';
        if ($menu->is_category) {
            $menuType = 'category';
        } elseif (is_null($menu->url) && !is_null($menu->category_id)) {
            $menuType = 'dropdown';
        }

        // Get all possible dropdowns for each category, including the current menu's dropdown
        $dropdownOptions = [];
        foreach ($categories as $category) {
            $dropdownOptions[$category->id] = Menu::where('category_id', $category->id)
                ->where('url', null)
                ->where('dropdown_id', null)
                ->where('is_category', false)
                ->when($menu->exists, function($query) use ($menu) {
                    return $query->orWhere('id', $menu->dropdown_id); // Include current dropdown if exists
                })
                ->get(['id', 'name']);
        }

        return [
            'menu' => $menu,
            'roles' => $roles,
            'roleOld' => $roleOld,
            'menus' => $menus,
            'categories' => $categories,
            'dropdownOptions' => $dropdownOptions,
            'menuType' => $menuType
        ];
    }

    public function updateMenu(Menu $menu, array $data)
    {
        $url = isset($data['url']) ? '/' . Str::slug($data['url']) : null;
        
        // Determine category_id based on dropdown selection or direct input
        $categoryId = $data['dropdown_id'] 
            ? Menu::find($data['dropdown_id'])->category_id 
            : ($data['category_id'] ?? null);

        // Update menu
        $menu->update([
            'name' => $data['name'],
            'url' => $url,
            'is_category' => $data['type'] === 'category',
            'dropdown_id' => $data['dropdown_id'] ?? null,
            'category_id' => $categoryId,
        ]);

        // Sync roles
        $menu->roles()->sync($data['roles']);
        
        // Update cache
        $this->updateCacheMenus();

        return $menu;
    }

    public function deleteMenu(Menu $menu)
    {
        $menu->roles()->detach(); // Hapus hubungan dengan menus sebelum menghapus menu
        $this->updateCacheMenus(); // Perbarui session setelah menghapus menu

        return $menu->delete();
    }
}