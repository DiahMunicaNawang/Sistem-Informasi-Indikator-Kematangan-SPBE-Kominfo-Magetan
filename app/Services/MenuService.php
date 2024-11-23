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
        $menus = Menu::with(['roles', 'categoryChildren', 'dropdownChildren'])->get();
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
        
        // Get all categories
        $categories = Menu::where('is_category', true)->get();

        // Determine menu type
        $menuType = 'menu';
        if ($menu->is_category) {
            $menuType = 'category';
        } elseif (is_null($menu->url) && !is_null($menu->category_id)) {
            $menuType = 'dropdown';
        }

        // Get dropdown options for each category
        $dropdownOptions = [];
        foreach ($categories as $category) {
            $dropdownQuery = Menu::where('category_id', $category->id)
                ->where('url', null)
                ->where('dropdown_id', null)
                ->where('is_category', false)
                ->where('id', '!=', $id); // Exclude current menu if it's a dropdown

            // If current menu has a dropdown_id, include its parent dropdown
            if ($menu->dropdown_id) {
                $dropdownQuery->orWhere('id', $menu->dropdown_id);
            }

            $dropdownOptions[$category->id] = $dropdownQuery->get(['id', 'name']);
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
