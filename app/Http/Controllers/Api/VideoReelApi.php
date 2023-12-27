<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VideoReel;
use App\Models\VideoReelFavorite;
use Illuminate\Http\Request;

class VideoReelApi extends Controller
{
    public function reelIndexFetch($user_id)
    {
        $user = User::find($user_id);

        $reels = VideoReel::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($reels as $reel) {
            $isFavorited = $user->videoReelFavorites()->where('video_reel_id', $reel->id)->exists();

            $reelData = [
                'id' => $reel->id,
                'title' => $reel->title,
                'subtitle' => $reel->subtitle,
                'video_link' => $reel->video_link,
                'favourite' => $isFavorited,

            ];
           
            $response[] = $reelData;
        }
        return response()->json([
            'message' => 'Reel List:',
            'data' => $response,
        ]);
    }
    public function store(Request $request, $user_id, $reel_id)
    {
        $user = User::find($user_id);
        $videoReel = VideoReel::find($reel_id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        if (!$videoReel) {
            return response()->json(['message' => 'Video reel not found'], 404);
        }
    
        $favorite = $user->videoReelFavorites()->where('video_reel_id', $videoReel->id)->first();
    
        if ($favorite) {
            $favorite->delete();
            $videoReel->decrement('favourite');
            return response()->json(['message' => 'Video reel unfavorited successfully'], 200);
        } else {
            $favorite = new VideoReelFavorite();
            $favorite->user_id = $user->id;
            $favorite->video_reel_id = $videoReel->id;
            $favorite->save();
    
            $videoReel->increment('favourite');
    
            return response()->json(['message' => 'Video reel favorited successfully'], 200);
        }
    }
    
    
    
}
