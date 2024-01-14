<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $homeSection = HomeSection::count();
        $radio= Radio::count();
    
        $podcastCategory = PodcastCategory::count();
        $user = User::count();
        return view('backend.admin.dashboard', compact('radio', 'podcastCategory','homeSection','user'));
    }
}
