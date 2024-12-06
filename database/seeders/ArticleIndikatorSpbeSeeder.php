<?php

namespace Database\Seeders;

use App\Models\IndikatorSPBE;
use App\Models\Article\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleIndikatorSpbeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $article = Article::all();
        $indikator_spbe = IndikatorSPBE::all();

        foreach (range(1, 5) as $index) {
            $articleIndikators = [
                'article_id' => $article->random()->id,
                'indikator_id' => $indikator_spbe->random()->id
            ];

            DB::table('article_indikator_spbe')->insert($articleIndikators);
        }
    }
}
