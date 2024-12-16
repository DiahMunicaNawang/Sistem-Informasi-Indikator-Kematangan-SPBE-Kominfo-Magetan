<?php

namespace App\Models;

use App\Models\Article\Article;
use App\Models\Forum\ForumDiscussion;
use Illuminate\Database\Eloquent\Model;

class IndikatorSPBE extends Model
{
    protected $table = 'indikator_spbes';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_indikator_spbe', 'indikator_id', 'article_id');
    }

    public function forums() {
        return $this->belongsToMany(ForumDiscussion::class, 'forum_indikator_spbe', 'indikator_id', 'forum_id');
    }
}
