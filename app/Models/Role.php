<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function menus() {
        return $this->belongsToMany(Menu::class, 'role_menu');
    }
}
