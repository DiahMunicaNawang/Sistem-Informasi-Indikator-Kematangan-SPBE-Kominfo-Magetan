<?php

namespace App\Models\Article;

use App\Models\User;
use App\Models\Article\ArticleCategory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article\ArticleValidation;
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
        'category_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_user_id');
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function validations()
    {
        return $this->hasMany(ArticleValidation::class);
    }

    public function ratings()
    {
        return $this->hasMany(ArticleRating::class);
    }

    // Accessor untuk mengambil rata-rata rating
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating_value');
    }
}
