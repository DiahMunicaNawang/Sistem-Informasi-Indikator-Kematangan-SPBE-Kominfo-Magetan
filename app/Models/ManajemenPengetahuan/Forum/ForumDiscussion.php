<?php

namespace App\Models\ManajemenPengetahuan\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ForumDiscussion extends Model
{
    public $timestamps = false;
    
    protected $guarded = ['id'];
    
    public function forum_category() {
        return $this->belongsTo(ForumCategory::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
