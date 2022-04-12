<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoMenu extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'image', 'info'];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
