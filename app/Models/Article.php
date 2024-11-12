<?php

namespace App\Models;

use App\Models\ArticleCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    //
    use HasFactory;
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'article_summary',
        'article_content',
        'article_status',
        'user_id',
        'validator_user_id',
    ];

    // Relationship to the user who created the article
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the user who validated the article
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_user_id');
    }

    // Relationship to the article's validations
    public function validations()
    {
        return $this->hasMany(ArticleValidation::class, 'article_id');
    }

    // Relationship to the article's ratings
    public function ratings()
    {
        return $this->hasMany(ArticleRating::class, 'article_id');
    }

    // Relationship to categories (assuming articles can belong to multiple categories)
    public function categories()
    {
        return $this->belongsToMany(ArticleCategories::class, 'article_category_pivot', 'article_id', 'category_id');
    }
}
