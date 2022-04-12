<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dzikir extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'long_title', 'description', 'categories', 'doa_latin', 'doa_arab', 'description_doa'];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
