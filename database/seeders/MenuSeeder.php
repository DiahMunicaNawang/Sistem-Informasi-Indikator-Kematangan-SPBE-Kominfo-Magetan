<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate(); // Clear existing menus to avoid duplication

        // 1. Create Categories First
        $categories = [
            [
                'name' => 'Home',
                'url' => null,
                'is_category' => true,
            ],
            [
                'name' => 'Kelola Pelayanan',
                'url' => null,
                'is_category' => true,
            ],
            [
                'name' => 'Kelola Pengguna',
                'url' => null,
                'is_category' => true,
            ],
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $menu = Menu::create($category);
            $categoryIds[$menu->name] = $menu->id;
        }

        // 2. Create Dropdown Parent
        $dropdownParent = Menu::create([
            'name' => 'Manajemen SPBE Aspek 5',
            'url' => null,
            'is_category' => false,
            'category_id' => $categoryIds['Kelola Pelayanan'],
        ]);

        // 3. Create Regular Menus
        $menus = [
            // Home menus
            [
                'name' => 'Dashboard',
                'url' => '/',
                'is_category' => false,
                'category_id' => $categoryIds['Home'],
            ],

            // Kelola Pelayanan menu
            [
                'name' => 'Indikator 26: Manajemen Pengetahuan',
                'url' => '/manajemen-pengetahuan',
                'category_id' => $categoryIds['Kelola Pelayanan'],
                'dropdown_id' => $dropdownParent->id,
            ],

            // Kelola Pengguna menus
            [
                'name' => 'Daftar Pengguna',
                'url' => '/user',
                'category_id' => $categoryIds['Kelola Pengguna'],
            ],
            [
                'name' => 'Daftar Peran',
                'url' => '/role',
                'category_id' => $categoryIds['Kelola Pengguna'],
            ],
            [
                'name' => 'Daftar Menu',
                'url' => '/menu',
                'category_id' => $categoryIds['Kelola Pengguna'],
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}