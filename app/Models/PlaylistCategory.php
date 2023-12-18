<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistCategory extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'title', 'status'];

    public function musics()
    {
        return $this->belongsToMany(PlaylistMusic::class, 'playlist_category_music');
    }
}
