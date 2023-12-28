<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\PlaylistCategory;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Radio;
use App\Models\User;
use App\Models\VideoReel;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $homeSection = HomeSection::count();
        $radio= Radio::count();
        $playlistCategory = PlaylistCategory::count();
        $playlistMusic = PlaylistMusic::count();
        $podcastCategory = PodcastCategory::count();
        $user = User::count();
        $reel = VideoReel::count();
        return view('backend.admin.dashboard', compact('radio', 'playlistCategory', 'playlistMusic', 'podcastCategory','homeSection','user','reel'));
    }
}
