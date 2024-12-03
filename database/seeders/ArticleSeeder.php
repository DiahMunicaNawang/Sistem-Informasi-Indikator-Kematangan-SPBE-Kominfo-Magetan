<?php

namespace Database\Seeders;

use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = ArticleCategory::all();
        $users = User::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Pastikan user dan category ada isinya, brother.');
            return;
        }

        foreach (range(1, 20) as $index) {
            // Generate random dates
            $randomDate = $faker->dateTimeBetween('-6 months', 'now');
            $createdAt = $randomDate;
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            Article::create([
                'title' => $faker->sentence,
                'article_summary' => $faker->paragraph,
                'article_content' => $faker->text(800),
                'article_status' => $faker->randomElement(['draft', 'published']),
                'user_id' => $users->random()->id,
                'validator_user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'image' => $faker->imageUrl(640, 480, 'articles', true),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
