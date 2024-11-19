<?php

namespace App\Models\ManajemenPengetahuan\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // Accessor untuk membuat atribut virtual 'short_description'
    public function getShortDescriptionAttribute()
    {
        // Potong teks deskripsi menjadi 100 karakter
        return Str::limit($this->description, 300, '...');
    }
}
