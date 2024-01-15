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
        $podcastCategory = PodcastCategory::where('status','active')->orderBy('created_at', 'desc')->get();

        foreach ($podcastCategory as $record) {
            $imageName = $record->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $record->image = $imageUrl;
        }
        return response()->json([
            'message' => 'Podcast Category List:',
            'data' => $podcastCategory,
        ]);
    }
    public function podcastCategoryshow($id)
    {
        $podcastCatgory = PodcastCategory::find($id);
        $podcasts = Podcast::where('status','active')->where('podcast_category_id', $podcastCatgory->id)->orderBy('created_at', 'desc')->get();
      
        if (!$podcastCatgory) {
            return response()->json('No Category Exits');
        }
        $imageNameCategory = $podcastCatgory->image;
        $imageUrlCategory = asset('podcast/image/' . $imageNameCategory);
        $podcastCatgory->image = $imageUrlCategory;

        foreach ($podcasts as $record) {
            $imageName = $record->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $record->image = $imageUrl;
    
            if($record->audio_link){
                $record->audio_link =$record->audio_link;
            }elseif($record->audio){
                $audioName = $record->audio;
                $audioUrl = asset('podcast/audio/' . $audioName);
                $record->audio_link = $audioUrl;
            }else $record->audio_link = 'no audio';

        }
        return response()->json([
            'message' => 'Podcast Category List:',
            'podcastCatgory' => $podcastCatgory,
            'podcasts' => $podcasts,
        ]);
    }

    public function podcastDetails($id)
    {
        $podcast = podcast::where('status','active')->find($id);
    
        if (!$podcast) {
            return response()->json('No Podcast Exits');
        }
            $imageName = $podcast->image;
            $imageUrl = asset('podcast/image/' . $imageName);
            $podcast->image = $imageUrl;
            if($podcast->audio_link){
                $podcast->audio_link =$podcast->audio_link;
            }elseif($podcast->audio){
                $audioName = $podcast->audio;
                $audioUrl = asset('podcast/audio/' . $audioName);
                $podcast->audio_link = $audioUrl;
            }else $podcast->audio_link = 'no audio';

        return response()->json([
            'message' => 'Podcast Details:',
            'data' => $podcast,
        ]);
    }

}
