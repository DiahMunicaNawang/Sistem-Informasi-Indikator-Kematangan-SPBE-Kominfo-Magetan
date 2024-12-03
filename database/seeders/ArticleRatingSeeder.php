<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article\Article;
use App\Models\Article\ArticleRating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;


class ArticleRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua artikel dan pengguna dari database
        $articles = Article::where('article_status', 'published')->get(); // Hanya artikel dengan status "published"
        $users = User::all();

        if ($articles->isEmpty() || $users->isEmpty()) {
            $this->command->info('Please make sure there are published articles and users before running this seeder.');
            return;
        }

        foreach ($articles as $article) {
            // Tambahkan beberapa rating untuk setiap artikel
            foreach (range(1, rand(1, 5)) as $index) { // Setiap artikel dapat memiliki 1 hingga 5 rating
                // Generate random dates
                $randomDate = $faker->dateTimeBetween('-6 months', 'now'); // Tanggal acak dari 6 bulan terakhir hingga sekarang
                $createdAt = $randomDate;
                $updatedAt = $faker->dateTimeBetween($createdAt, 'now'); // Tanggal acak setelah created_at hingga sekarang

                ArticleRating::create([
                    'article_id' => $article->id,
                    'rater_user_id' => $users->random()->id,
                    'rating_value' => $faker->numberBetween(1, 5), // Nilai rating antara 1 hingga 5
                    'review' => $faker->text(800),
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);
            }
        }
    }
}
