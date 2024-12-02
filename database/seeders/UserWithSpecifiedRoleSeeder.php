<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserWithSpecifiedRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'superadmin@gmail.com',
                'username' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'role_id' => Role::where('name', 'super-admin')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'admininstansi@gmail.com',
                'username' => 'admininstansi',
                'password' => Hash::make('admininstansi'),
                'role_id' => Role::where('name', 'admin-instansi')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'manajerkonten@gmail.com',
                'username' => 'manajerkonten',
                'password' => Hash::make('manajerkonten'),
                'role_id' => Role::where('name', 'manajer-konten')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'penggunaterdaftar@gmail.com',
                'username' => 'penggunaterdaftar',
                'password' => Hash::make('penggunaterdaftar'),
                'role_id' => Role::where('name', 'pengguna-terdaftar')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'penggunaumum@gmail.com',
                'username' => 'penggunaumum',
                'password' => Hash::make('penggunaumum'),
                'role_id' => Role::where('name', 'pengguna-umum')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'tenagaahli@gmail.com',
                'username' => 'tenagaahli',
                'password' => Hash::make('tenagaahli'),
                'role_id' => Role::where('name', 'tenaga-ahli')->first()->id,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
