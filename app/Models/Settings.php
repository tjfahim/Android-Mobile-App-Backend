<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['logo', 'title', 'favicon','app_topber_logo','appstore_share_link','playstore_share_link'];

}
