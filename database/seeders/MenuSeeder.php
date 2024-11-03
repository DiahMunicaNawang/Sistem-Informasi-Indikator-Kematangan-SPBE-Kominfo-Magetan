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
                'name' => 'Dashboard',
                'url' => '/',
                'order' => '1',
            ],
            [
                'name' => 'User Management',
                'url' => '/user',
                'order' => '2',
            ],
            [
                'name' => 'Role Management',
                'url' => '/role',
                'order' => '3',
            ],
            [
                'name' => 'Menu Management',
                'url' => '/menu',
                'order' => '4',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
