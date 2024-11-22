<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MenuService
{
    public function getAllMenus()
    {
        $menus = Menu::with('roles')->get();
        return [
            'menus' => $menus
        ];
    }

    public function createMenu() {
        $roles = Role::all();
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

        return $menu;
    }

    public function editMenu(int $id)
    {
        $menu = Menu::findOrFail($id);

        $roles = Role::all();
        $roleOld = $menu->roles->pluck('id')->toArray();
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
            'categories' => $categories,
            'dropdownOptions' => $dropdownOptions,
            'menuType' => $menuType
        ];
    }

    public function updateMenu(array $data, int $id)
    {
        $menu = Menu::findOrFail($id);
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

        return $menu;
    }

    public function deleteMenu(int $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->roles()->detach(); // Hapus hubungan dengan menus sebelum menghapus menu
        // $this->updateCacheMenus(); // Perbarui session setelah menghapus menu

        return $menu->delete();
    }
}
