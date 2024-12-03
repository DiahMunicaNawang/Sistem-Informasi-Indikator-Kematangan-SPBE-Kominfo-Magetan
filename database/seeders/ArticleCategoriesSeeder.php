<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article\ArticleCategory;

class ArticleCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Science'];

        foreach ($categories as $category){
            ArticleCategory::create([
                'category_name' => $category,
            ]);
        }
    }
}
