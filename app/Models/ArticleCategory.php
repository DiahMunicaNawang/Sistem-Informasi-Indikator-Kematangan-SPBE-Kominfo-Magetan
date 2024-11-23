<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = [
        'category_name',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
