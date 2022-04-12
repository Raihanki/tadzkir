<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function info_menu() {
        return $this->hasOne(InfoMenu::class, 'menu_id', 'id');
    }

    public function dzikirs() {
        return $this->hasMany(Dzikir::class);
    }
}
