<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoApi extends Controller
{
    public function videoIndexFetch()
    {
        $videoRecords = Video::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($videoRecords as $video) {
            $videoData = [
                'id' => $video->id,
                'title' => $video->title,
                'video_link' => $video->video_link,
                'details' => $video->details,
                'image' => asset('image/video/' . $video->image),
            ];
         
            $response[] = $videoData;
        }
        return response()->json([
            'message' => 'Video List:',
            'data' => $response,
        ]);
    }
 
   
}
