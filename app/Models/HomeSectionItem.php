<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionItem extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'playlist_categorie_id','podcast_categorie_id','playlist_music_id', 'podcast_id','home_section_id','status'];


    public function music()
    {
        return $this->belongsTo(PlaylistMusic::class, 'playlist_music_id');
    }
    public function podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }
    public function podcastCategory()
    {
        return $this->belongsTo(PodcastCategory::class, 'podcast_categorie_id');
    }
    public function playlistMusic()
    {
        return $this->belongsTo(PlaylistCategory::class, 'playlist_categorie_id');
    }



}
