<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategories extends Model
{
    use HasFactory;

    protected $table = 'article_categories';


    protected $fillable = [
        'category_name',
    ];

    // Relationship to articles that belong to this category
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category_pivot', 'category_id', 'article_id');
    }
}
