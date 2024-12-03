<?php

namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ForumResponse extends Model
{
    protected $guarded = ['id'];

    public function replies()
    {
        return $this->hasMany(ForumResponse::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
