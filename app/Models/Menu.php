<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_menu');
    }
}
