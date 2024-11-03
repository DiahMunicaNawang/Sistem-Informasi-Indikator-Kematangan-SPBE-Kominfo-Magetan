<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuService
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

    public function getAllMenus()
    {
        // Eager load 'roles' untuk menghindari query N+1
        return Menu::with('roles')->orderBy('order', 'ASC')->get();
    }

    public function createMenu() {
        $roles = Role::all(); // Get all roles for dropdown
        $menus = Menu::orderBy('order')->get();

        return [
            'roles' => $roles,
            'menus' => $menus
        ];
    }

    public function storeMenu(array $data)
    {
        // Tentukan urutan baru berdasarkan input 'order'
        if ($data['order'] === 'beginning') {
            // Jika user memilih 'beginning', set urutan menjadi 1
            $newOrder = 1;
    
            // Geser semua menu lain ke bawah untuk memberi ruang di urutan pertama
            Menu::where('order', '>=', 1)->increment('order');
        } else {
            // Pisahkan input 'order' menjadi bagian angka dan posisi (after/before)
            [$baseOrder, $position] = explode('-', $data['order']);
            $baseOrder = (int) $baseOrder;
    
            // Tentukan urutan baru berdasarkan posisi
            $newOrder = $position === 'after' ? $baseOrder + 1 : $baseOrder;
    
            // Geser menu lain ke bawah untuk memberi ruang pada posisi baru
            Menu::where('order', '>=', $newOrder)->increment('order');
        }

        // Convert URL to slug
        $url = '/' . Str::slug($data['url']);
        $menu = Menu::create([
            'name' => $data['name'],
            'url' => $url,
            'order' => $newOrder,
        ]);

        $menu->roles()->attach($data['roles']);

        $this->updateSessionMenus();

        return $menu;
    }

    public function editMenu(Menu $menu) {
        $roles = Role::all(); // Get all roles for dropdown
        $roleOld = $menu->roles->pluck('id')->toArray(); // Get selected roles
        $menus = Menu::orderBy('order')->get();

        return [
            'menu' => $menu,
            'roles' => $roles,
            'roleOld' => $roleOld,
            'menus' => $menus
        ];
    }

    public function updateMenu(Menu $menu, array $data)
    {
        // Tentukan urutan baru berdasarkan input 'order'
        if ($data['order'] === 'beginning') {
            // Jika user memilih 'beginning', set urutan menjadi 1
            $newOrder = 1;
        } else {
            // Pisahkan input 'order' menjadi bagian angka dan posisi (after/before)
            [$baseOrder, $position] = explode('-', $data['order']);
            $baseOrder = (int) $baseOrder;

            // Temukan urutan tertinggi saat ini
            $maxOrder = Menu::max('order');

            // Tentukan urutan baru berdasarkan posisi dan urutan dasar
            $newOrder = ($position === 'after' && $baseOrder >= $maxOrder) ? $maxOrder : ($position === 'after' ? $baseOrder + 1 : $baseOrder);
        }

        // Jika urutan baru lebih kecil, geser menu lain ke atas
        if ($newOrder < $menu->order) {
            Menu::whereBetween('order', [$newOrder, $menu->order - 1])
                ->where('id', '!=', $menu->id)
                ->increment('order');
        } elseif ($newOrder > $menu->order) {
            // Jika urutan baru lebih besar, geser menu lain ke bawah
            Menu::whereBetween('order', [$menu->order + 1, $newOrder])
                ->where('id', '!=', $menu->id)
                ->decrement('order');
        }

        // Convert URL to slug
        $url = '/' . Str::slug($data['url']);

        $menu->update([
            'name' => $data['name'],
            'url' => $url,
            'order' => $newOrder,
        ]);

        $menu->roles()->sync($data['roles']);

        $this->updateSessionMenus();

        return $menu;
    }

    public function deleteMenu(Menu $menu)
    {
        $menu->roles()->detach(); // Hapus hubungan dengan menus sebelum menghapus menu
        $this->updateSessionMenus(); // Perbarui session setelah menghapus menu

        return $menu->delete();
    }
}