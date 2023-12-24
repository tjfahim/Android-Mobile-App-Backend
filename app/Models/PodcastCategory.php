<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'status','background_color'];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
}
