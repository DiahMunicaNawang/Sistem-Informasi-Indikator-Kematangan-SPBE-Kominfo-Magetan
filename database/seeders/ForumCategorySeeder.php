<?php

namespace Database\Seeders;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Science'];

        foreach ($categories as $category){
            ForumCategory::create([
                'name' => $category,
            ]);
        }
    }
}
