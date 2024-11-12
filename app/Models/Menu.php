<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $guarded = ['id'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_menu');
    }
    
    public function categoryChildren()
    {
        // Mengambil submenu berdasarkan category_id
        return $this->hasMany(Menu::class, 'category_id');
    }

    public function dropdownChildren()
    {
        // Mengambil submenu berdasarkan dropdown_id
        return $this->hasMany(Menu::class, 'dropdown_id');
    }
}
