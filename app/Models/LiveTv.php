<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveTv extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'chat_code_link', 'embed_code_link','image', 'status'];

}