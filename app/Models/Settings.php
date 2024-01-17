<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['logo', 'title', 'favicon','app_topber_logo','whats_app_logo', 'phone_logo', 'whats_app','phone','appstore_share_link','playstore_share_link','menu_bar_background'];

}
