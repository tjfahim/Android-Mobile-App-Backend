<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistMusic extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'feature_image', 'title', 'subtitle', 'artist', 'music_file', 'music_link', 'status'];

    public function categories()
    {
        return $this->belongsToMany(PlaylistCategory::class, 'playlist_category_music');
    }
}
