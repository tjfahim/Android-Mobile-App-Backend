<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['podcast_category_id', 'title', 'subtitle', 'video','video_link','audio_link', 'audio', 'image', 'status', 'android_listener', 'ios_listener','connected_user'];

    public function category()
    {
        return $this->belongsTo(PodcastCategory::class, 'podcast_category_id');
    }
}
$table->unsignedBigInteger('podcast_category_id');
$table->string('title');
$table->string('subtitle')->nullable();
$table->string('audio')->nullable();
$table->string('audio_link')->nullable();
$table->string('image')->nullable();
$table->integer('android_listener')->default(0);
$table->integer('ios_listener')->default(0);
$table->integer('connected_user')->default(0);
$table->string('status')->default('active');