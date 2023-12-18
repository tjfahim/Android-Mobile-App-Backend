<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioCustomCategoryItem extends Model
{
    use HasFactory;
    protected $fillable = [ 'playlist_music_id','podcast_id','radio_custom_categorie_id', 'status'];

    
    public function music()
    {
        return $this->belongsTo(PlaylistMusic::class, 'playlist_music_id');
    }
    public function podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }
}
