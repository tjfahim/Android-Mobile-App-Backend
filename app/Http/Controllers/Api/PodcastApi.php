<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;

class PodcastApi extends Controller
{
    public function podcastCategoryindex()
    {
        $podcastCategory = PodcastCategory::orderBy('created_at', 'desc')->get();

        foreach ($podcastCategory as $record) {
            $imageName = $record->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $record->image = $imageUrl;
        }
        return response()->json($podcastCategory);
    }
    public function podcastCategoryshow($id)
    {
        $podcastCatgory = PodcastCategory::find($id);
        $podcasts = Podcast::where('podcast_category_id', $podcastCatgory->id)->orderBy('created_at', 'desc')->get();
      
        if (!$podcastCatgory) {
            return response()->json('No Category Exits');
        }
        foreach ($podcasts as $record) {
            $imageName = $record->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $record->image = $imageUrl;
            if($record->video){
                $videoName = $record->video;
                $videoUrl = asset('podcast/video/' . $videoName);
                $record->video_link = $videoUrl;
            }
            if($record->audio){

                $audioName = $record->audio;
                $audioUrl = asset('podcast/audio/' . $audioName);
                $record->audio_link = $audioUrl;
            }
        }
        return response()->json($podcasts);
    }

    public function podcastDetails($id)
    {
        $podcast = podcast::find($id);
    
        if (!$podcast) {
            return response()->json('No Podcast Exits');
        }
            $imageName = $podcast->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $podcast->image = $imageUrl;
            if($podcast->video){
                $videoName = $podcast->video;
                $videoUrl = asset('podcast/video/' . $videoName);
                $podcast->video_link = $videoUrl;
            }
            if($podcast->audio){
                $audioName = $podcast->audio;
                $audioUrl = asset('podcast/audio/' . $audioName);
                $podcast->audio_link = $audioUrl;
            }

        return response()->json($podcast);
    }

}
