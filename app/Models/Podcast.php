<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['podcast_category_id', 'title', 'subtitle', 'video','video_link','audio_link', 'audio', 'image', 'status','background_color'];

    public function category()
    {
        return $this->belongsTo(PodcastCategory::class, 'podcast_category_id');
    }
}
