<?php

namespace App\Models\Forum;

use App\Models\IndikatorSPBE;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ForumDiscussion extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function indikators() {
        return $this->belongsToMany(IndikatorSPBE::class, 'forum_indikator_spbe', 'forum_id', 'indikator_id');
    }

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

    public function responses() {
        return $this->hasMany(ForumResponse::class);
    }
}
