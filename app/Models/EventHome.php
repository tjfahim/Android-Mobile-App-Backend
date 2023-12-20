<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHome extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'title', 'status', 'subtitle', 'event_link'];

}