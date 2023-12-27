<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoReel extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'video_link','favourite','status'];
    public function favorites()
    {
        return $this->hasMany(VideoReelFavorite::class);
    }
}
