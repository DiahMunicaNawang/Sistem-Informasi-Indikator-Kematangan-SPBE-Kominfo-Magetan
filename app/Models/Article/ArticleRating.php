<?php

namespace App\Models\Article;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleRating extends Model
{
    //
    use HasFactory;

    protected $table = 'article_ratings';

    protected $fillable = [
        'article_id',
        'rater_user_id',
        'rating_value',
        'rating_date',
        'review',
    ];

    // Relationship to the article being rated
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    // Relationship to the user who gave the rating
    public function user()
    {
        return $this->belongsTo(User::class, 'rater_user_id');
    }


}
