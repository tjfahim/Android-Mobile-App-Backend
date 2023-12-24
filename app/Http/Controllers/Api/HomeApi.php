<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventHome;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\PlaylistCategory;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Radio;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeApi extends Controller
{
    public function HomeSectionIndexfetch()
    {
        $homeSections = HomeSection::where('status','active')->orderBy('created_at', 'desc')->get();
    
        $response = [];
    
        foreach ($homeSections as $section) {
            $sectionDataItem = [
                'section_id' => $section->id,
                'section_name' => $section->title,
                'items' => [],
            ];
    
            $sectionItems = HomeSectionItem::where('status','active')->where('home_section_id', $section->id)->get();
            foreach ($sectionItems as $item) {
                $itemTitle = null;
                $itemSubTitle = null;
                $itemImage_link = null;
                $itemAudio_link = null;
                $itemType = null;
                $itemDetailsLink = null;
    
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
                } elseif (!is_null($item->playlist_categorie_id)) {
                    $playlist = PlaylistCategory::find($item->playlist_categorie_id);
                    if ($playlist) {
                        $itemTitle = $playlist->title;
                        $itemType = 'Playlist';
                        $itemImage_link = asset('image/playlist/' . $playlist->image);
                        $itemDetailsLink = route('playlistcategory.details.fetch', ['id' => $playlist->id]);

                        
                    }
                } elseif (!is_null($item->podcast_categorie_id)) {
                    $podcast = PodcastCategory::find($item->podcast_categorie_id);
                    if ($podcast) {
                        $itemTitle = $podcast->title;
                        $itemType = 'Podcast';
                        $itemImage_link = asset('podcast/image/' . $podcast->image);
                        $itemDetailsLink = route('podcast.details.fetch', ['id' => $podcast->id]);

                    }
                } elseif (!is_null($item->event_id)) {
                    $event = EventHome::find($item->event_id);
                    if ($event) {
                        $itemTitle = $event->title;
                        $itemType = 'Event';
                        $itemImage_link = asset('image/event' . $event->image);
                        $itemDetailsLink = $event->event_link;
                    }
                }
    
                if (!is_null($itemTitle)) {
                    $sectionDataItem['items'][] = [
                        'id' => $item->id,
                        'title' => $itemTitle,
                        'subtitle' => $itemSubTitle,
                        'image_link' => $itemImage_link,
                        'audio' => $itemAudio_link,
                        'detailsPageLink' => $itemDetailsLink,
                        'type' => $itemType,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }
            }
    
            $response[] = $sectionDataItem;
        }
        $RadioRecords = Radio::where('status','active')->orderBy('created_at', 'desc')->get();
        $sliders = Slider::where('status','active')->orderBy('created_at', 'desc')->get();
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
    
            $responseRadio[] = $radioData;
        }
        foreach ($sliders as $slider) {
            $sliderData = [
                'id' => $slider->id,
                'title' => $slider->title,
                'slider_link' => $slider->slider_link,
                'image' => asset('image/slider/' . $slider->image),
            ];
          
            $responseSlider[] = $sliderData;
        }
        return response()->json([
            'message' => 'All Section With Item List:',
            'Slider Data' => $responseSlider,
            'Radio data' => $responseRadio,
            'Section data' => $response,
        ]);
    }
    
}
