<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioCustomCategory extends Model
{
    use HasFactory;
    protected $fillable = [ 'title','radio_id','image','status'];

}
