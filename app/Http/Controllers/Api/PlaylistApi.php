<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaylistCategory;
use App\Models\PlaylistCategoryMusic;
use App\Models\PlaylistMusic;
use Illuminate\Http\Request;

class PlaylistApi extends Controller
{
    
    public function playlistCatgoryIndex()
    {
        $playlistCatgory = PlaylistCategory::orderBy('created_at', 'desc')->get();
        foreach ($playlistCatgory as $record) {
            $imageName = $record->image;
            $imageUrl = asset('image/playlist/' . $imageName);
            $record->image = $imageUrl;
        }
            return response()->json([
                'message' => 'Playlist Category List:',
                'data' => $playlistCatgory,
            ]);
     }

   
    public function playlistCategoryMusicshow($id)
    {
        $playlistCategoryMusics = PlaylistCategoryMusic::where('playlist_category_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        $musicList = [];
    
        foreach ($playlistCategoryMusics as $playlistCategoryMusic) {
            $musicId = $playlistCategoryMusic->playlist_music_id;
            $music = PlaylistMusic::find($musicId);
    
            if ($music) {
                $imageName = $music->image;
                $imageUrl = asset('image/music/' . $imageName);
                $music->image = $imageUrl;
    
                $featureImageName = $music->feature_image;
                $featureImageUrl = asset('image/music/' . $featureImageName);
                $music->feature_image = $featureImageUrl;
    
                if ($music->music_file) {
                    $musicFileName = $music->music_file;
                    $musicFileUrl = asset('music_file/' . $musicFileName);
                    $music->music_link = $musicFileUrl;
                }
    
                $musicList[] = $music;
            }
        }
        return response()->json([
            'message' => 'Playlist Single Category All Music List:',
            'data' => $musicList,
        ]);
    }

    public function playlistMusicDetails($id)
    {
        $music = PlaylistMusic::find($id);
    
        if (!$music) {
            return response()->json('No Podcast Exits');
        }
            $imageName = $music->image;
            $imageUrl = asset('image/music/' . $imageName);
            $music->image = $imageUrl;

            $feature_imageName = $music->feature_image;
            $feature_imageUrl = asset('image/music/' . $feature_imageName);
            $music->feature_image = $feature_imageUrl;

            if($music->music_link){
                $musicName = $music->music_link;
                $music->music_link = $musicName;
            }elseif($music->music_file){
                $musicName = $music->music_file;
                $musicUrl = asset('music_file/' . $musicName);
                $music->music_link = $musicUrl;
            }else{
                $music->music_link = 'No music';

            }

        return response()->json([
            'message' => 'Single Music Data:',
            'data' => $music,
        ]);
    }
}