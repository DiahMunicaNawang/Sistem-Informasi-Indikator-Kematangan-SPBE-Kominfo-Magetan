<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(RoleMenuSeeder::class);
        $this->call(ArticleCategoriesSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ArticleRatingSeeder::class);
        $this->call(ForumCategorySeeder::class);
        $this->call(UserWithSpecifiedRoleSeeder::class);
    }
}
