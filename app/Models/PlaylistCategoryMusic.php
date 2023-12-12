<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistCategoryMusic extends Model
{
    use HasFactory;
    protected $fillable = [
        'playlist_category_id',
        'playlist_music_id',
    ];


    public function category()
    {
        return $this->belongsTo(PlaylistCategory::class, 'playlist_category_id');
    }

    public function music()
    {
        return $this->belongsTo(PlaylistMusic::class, 'playlist_music_id');
    }
}
