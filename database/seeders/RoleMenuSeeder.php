<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        $dashboard = Menu::where('url', '/')->first();
        $user_management = Menu::where('url', '/user')->first();
        $role_management = Menu::where('url', '/role')->first();
        $menu_management = Menu::where('url', '/menu')->first();

        $super_admin->menus()->attach([$dashboard->id, $user_management->id, $role_management->id, $menu_management->id]);
        $admin->menus()->attach([$dashboard->id, $user_management->id, $menu_management->id]);
        $user->menus()->attach([$dashboard->id]);
    }
}
