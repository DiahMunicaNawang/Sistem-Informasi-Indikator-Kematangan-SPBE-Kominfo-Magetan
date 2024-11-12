<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Menu Utama',
                'is_category' => true,
            ],
            [
                'name' => 'Dashboard',
                'url' => '/',
            ],
            [
                'name' => 'User Management',
                'url' => '/user',
            ],
            [
                'name' => 'Role Management',
                'url' => '/role',
            ],
            [
                'name' => 'Menu Management',
                'url' => '/menu',
            ],
        ];

        $category = null;

        foreach ($menus as $menu) {
            if (isset($menu['is_category']) && $menu['is_category']) {
                $category = Menu::create($menu);
            } else {
                $menu['category_id'] = $category ? $category->id : null;
                Menu::create($menu);
            }
        }
    }
}
