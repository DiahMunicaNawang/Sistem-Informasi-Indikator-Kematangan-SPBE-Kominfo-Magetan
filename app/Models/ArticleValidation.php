<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleValidation extends Model
{
    //
    use HasFactory;

    protected $table = 'article_validations';

    protected $fillable = [
        'article_id',
        'validator_user_id',
        'validation_status',
        'comments',
        'validation_date',
    ];

    // Relationship to the article being validated
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    // Relationship to the user who validated the article
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_user_id');
    }
}
