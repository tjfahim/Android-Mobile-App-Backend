<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoReelFavorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'video_reel_id','status'];

}
