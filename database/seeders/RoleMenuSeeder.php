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
        $admin_instansi = Role::where('name', 'admin-instansi')->first();
        $manajer_konten = Role::where('name', 'manajer-konten')->first();
        $pengguna_terdaftar = Role::where('name', 'pengguna-terdaftar')->first();
        $pengguna_umum = Role::where('name', 'pengguna-umum')->first();
        $tenaga_ahli = Role::where('name', 'tenaga-ahli')->first();

        // Get Categories
        $home = Menu::where('name', 'Home')->first();
        $kelola_pelayanan = Menu::where('name', 'Kelola Pelayanan')->first();
        $kelola_pengguna = Menu::where('name', 'Kelola Pengguna')->first();

        // Get Menus
        $dashboard = Menu::where('url', '/')->first();
        $indikator_spbe = Menu::where('url', '/indikator-spbe')->first();
        $article = Menu::where('url', '/article')->first();
        $forum = Menu::where('url', '/forum-discussion')->first();
        $daftar_pengguna = Menu::where('url', '/user')->first();
        $daftar_role = Menu::where('url', '/role')->first();
        $daftar_menu = Menu::where('url', '/menu')->first();

        // Assign Permissions
        // Super Admin gets access to everything
        $super_admin->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $kelola_pengguna->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
            $daftar_pengguna->id,
            $daftar_role->id,
            $daftar_menu->id,
        ]);

        $manajer_konten->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $kelola_pengguna->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
            $daftar_menu->id,
        ]);

        $pengguna_terdaftar->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
        ]);

        $pengguna_umum->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
        ]);

        $admin_instansi->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
        ]);

        $tenaga_ahli->menus()->attach([
            $home->id,
            $kelola_pelayanan->id,
            $dashboard->id,
            $indikator_spbe->id,
            $article->id,
            $forum->id,
        ]);
    }
}
