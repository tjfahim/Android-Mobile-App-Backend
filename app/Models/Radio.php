<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'image', 'radio_file', 'radio_link', 'status','background_color','connected_user','ios_listener','android_listener'];

}
