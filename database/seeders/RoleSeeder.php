<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'super-admin',
            'admin-instansi',
            'manajer-konten',
            'pengguna-terdaftar',
            'pengguna-umum',
            'tenaga-ahli',
        ];

        foreach ($names as $name) {
            Role::create([
                'name' => $name,
            ]);
        }
    }
}
