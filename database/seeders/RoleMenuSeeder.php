<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Get Roles
        $super_admin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        // Get Categories
        $home = Menu::where('name', 'Home')->first();
        $kelola_pelayanan = Menu::where('name', 'Kelola Pelayanan')->first();
        $kelola_pengguna = Menu::where('name', 'Kelola Pengguna')->first();

        // Get Menus
        $dashboard = Menu::where('url', '/')->first();
        $manajemen_spbe = Menu::where('name', 'Manajemen SPBE Aspek 5')->first();
        $manajemen_pengetahuan = Menu::where('url', '/manajemen-pengetahuan')->first();
        $daftar_pengguna = Menu::where('url', '/user')->first();
        $daftar_peran = Menu::where('url', '/role')->first();
        $daftar_menu = Menu::where('url', '/menu')->first();

        // Assign Permissions
        // Super Admin gets access to everything
        $super_admin->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $kelola_pengguna->id,
            $dashboard->id,
            $manajemen_spbe->id,
            $manajemen_pengetahuan->id,
            $daftar_pengguna->id,
            $daftar_peran->id,
            $daftar_menu->id,
        ]);

        // Admin gets access to dashboard and some management features
        $admin->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $dashboard->id,
            $manajemen_spbe->id,
            $manajemen_pengetahuan->id,
        ]);

        // Regular user gets access to dashboard only
        $user->menus()->attach([
            $home->id,
            $dashboard->id,
        ]);
    }
}