<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\Radio;
use App\Models\RadioCustomCategory;
use App\Models\RadioCustomCategoryItem;
use Illuminate\Http\Request;

class RadioApi extends Controller
{
    
    public function radioIndexFetch()
    {

        $RadioRecords = Radio::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($RadioRecords as $radio) {
            $radioData = [
                'id' => $radio->id,
                'title' => $radio->title,
                'subtitle' => $radio->subtitle,
                'image' => asset('image/radio/' . $radio->image),
                'background_color' => 'oxff' . ltrim($radio->background_color, '#'),

            ];
            if (!is_null($radio->radio_file)) {
                $radioData['radio_link'] = asset('radio_file/' . $radio->radio_file);
            } elseif (!is_null($radio->radio_link)) {
                $radioData['radio_link'] = $radio->radio_link;
            } else {
                $radioData['radio_link'] = 'There is no radio';
            }
    
            $response[] = $radioData;
        }
        return response()->json([
            'message' => 'Radio List:',
            'data' => $response,
        ]);
    }
    public function RadioSectionIndexfetch($id)
    {


        $RadioRecords = Radio::find($id);
        if (!is_null($RadioRecords->image)) {
            $RadioRecords['image'] = asset('image/radio/' . $RadioRecords->image);
        }
        if (!is_null($RadioRecords->radio_file)) {
            $RadioRecords['radio_link'] = asset('radio_file/' . $RadioRecords->radio_file);
        } elseif (!is_null($RadioRecords->radio_link)) {
            $RadioRecords['radio_link'] = $RadioRecords->radio_link;
        } else {
            $RadioRecords['radio_link'] = 'There is no radio';
        }

        $radioSections = RadioCustomCategory::where('status','active')->where('radio_id', $id)->orderBy('created_at', 'desc')->get();
    
        $response = [];
    
        foreach ($radioSections as $section) {
            $sectionDataItem = [
                'section_id' => $section->id,
                'section_name' => $section->title,
                'items' => [],
            ];
    
            $sectionItems = RadioCustomCategoryItem::where('status','active')->where('radio_custom_categorie_id', $section->id)->get();
            foreach ($sectionItems as $item) {
                $itemTitle = null;
                $itemSubTitle = null;
                $itemImage_link = null;
                $itemAudio_link = null;
                $itemType = null;
    
                if (!is_null($item->playlist_music_id)) {
                    $playlist = PlaylistMusic::find($item->playlist_music_id);
                    if ($playlist) {
                        $itemTitle = $playlist->title;
                        $itemType = 'PlaylistMusic';
                        $itemSubTitle = $playlist->subtitle;
                        $itemImage_link = asset('image/music/' . $playlist->image);
                        if(!is_null($playlist->music_file)){
                            $itemAudio_link = asset('music_file/' . $playlist->music_file);
                        }elseif(!is_null($playlist->music_file)){
                            $itemAudio_link = $playlist->music_link;
                        }else(
                            $itemAudio_link = 'There is no audio'
                        );
                    }
                } elseif (!is_null($item->podcast_id)) {
                    // Fetch the podcast title if podcast_id is not null
                    $podcast = Podcast::find($item->podcast_id);
                    if ($podcast) {
                        $itemTitle = $podcast->title;
                        $itemType = 'Podcast';

                        $itemSubTitle = $podcast->subtitle;
                        $itemImage_link = asset('podcast/image/' . $podcast->image);
                        if(!is_null($podcast->audio)){
                            $itemAudio_link = asset('podcast/audio/' . $podcast->audio);
                        }elseif(!is_null($podcast->audio_file)){
                            $itemAudio_link = $podcast->audio_link;
                        }else(
                            $itemAudio_link = 'There is no audio'
                        );
                    }
                }
    
                if (!is_null($itemTitle)) {
                    $sectionDataItem['items'][] = [
                        'id' => $item->id,
                        'title' => $itemTitle,
                        'subtitle' => $itemSubTitle,
                        'image_link' => $itemImage_link,
                        'audio' => $itemAudio_link,
                        'type' => $itemType,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }
            }
    
            $response[] = $sectionDataItem;
        }
        return response()->json([
            'message' => 'All Section With Item List:',
            'radio' => $RadioRecords,
            'data' => $response,
        ]);
    }
    
   
}
