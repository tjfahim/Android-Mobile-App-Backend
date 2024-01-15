<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionItem extends Model
{
    use HasFactory;
    protected $fillable = ['radio_id','video_id', 'podcast_id','home_section_id','status'];


    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
    public function podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }
    public function radio()
    {
        return $this->belongsTo(Radio::class, 'radio_id');
    }
}
