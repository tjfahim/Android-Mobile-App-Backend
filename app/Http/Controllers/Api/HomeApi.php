<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\EventHome;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\MenuBar;
use App\Models\Podcast;
use App\Models\Radio;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeApi extends Controller
{
    public function search(Request $request,$query)
    {
        {
            $podcastResults = Podcast::where('title', 'like', "%{$query}%")
                ->where('status', 'active')
                ->get()
                ->map(function ($result) {
                    $result['itemType'] = 'podcast';
                    if(!is_null($result['image'])){
                        $result['image'] = asset('podcast/image/' . $result['image']);
                    }else(
                        $result['image'] = null
                    );
                    if(!is_null($result['audio'])){
                        $result['audio_link'] = asset('podcast/audio/' . $result['audio']);
                    }elseif(!is_null($result['audio_file'])){
                        $result['audio_link'] = $result['audio_link'];
                    }else(
                        $result['audio_link'] = 'There is no audio'
                    );
                    return $result;
                });

            // Search in the Radio table
            $radioResults = Radio::where('title', 'like', "%{$query}%")
                ->where('status', 'active')
                ->get()
                ->map(function ($result) {
                    $result['itemType'] = 'radio';
                    $result['image']  = asset('image/radio/' . $result['image']);
                    $result['background_color']  = 'oxff' . ltrim($result['background_color'], '#');
                    if (!is_null($result['radio_file'])) {
                        $result['audio_link'] = asset('radio_file/' . $result['radio_file']);
                    } elseif (!is_null($result['radio_link'])) {
                        $result['audio_link'] = $result['radio_link'];
                    } else {
                        $result['audio_link'] = 'There is no radio';
                    }
                    return $result;
                });

            $videoResults = Video::where('title', 'like', "%{$query}%")
                ->where('status', 'active')
                ->get()
                ->map(function ($result) {
                    $result['itemType'] = $result['type'];
                    return $result;
                });

            $results = $radioResults
                ->merge($podcastResults)
                ->merge($videoResults)
                ->toArray();

            return response()->json($results);
        }
    }
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
                $itemVideo_link = null;
                $itemType = null;
                $radio_id = null;
                $podcast_id = null;
    
                if (!is_null($item->podcast_id)) {
                    $podcast = Podcast::find($item->podcast_id);
                    if ($podcast) {
                        $podcast_id = $podcast->id;
                        $itemTitle = $podcast->title;
                        $itemType = 'podcast';
                        $itemSubTitle = $podcast->subtitle;
                        $itemImage_link = asset('podcast/image/' . $podcast->image);
                        if(!is_null($podcast->audio_link)){
                            $itemAudio_link = $podcast->audio_link;
                        }elseif(!is_null($podcast->audio)){
                            $itemAudio_link = asset('podcast/audio/' . $podcast->audio);
                        }else(
                            $itemAudio_link = 'There is no audio'
                        );
                    }
                } elseif (!is_null($item->radio_id)) {
                    $radio = radio::find($item->radio_id);
                    if ($radio) {
                        $radio_id = $radio->id;
                        $itemTitle = $radio->title;
                        $itemType = 'radio';
                        $itemSubTitle = $radio->subtitle;
                        $itemImage_link = asset('image/radio/' . $radio->image);
                        if(!is_null($radio->radio_link)){
                            $itemAudio_link = $radio->radio_link;
                        }else(
                            $itemAudio_link = 'There is no audio'
                        );
                    }
                } elseif (!is_null($item->video_id)) {
                    $video = Video::find($item->video_id);
                    if ($video) {
                        $itemTitle = $video->title;
                        $itemType =  $video->type;
                        $itemSubTitle = $video->details;
                        $itemImage_link = asset('image/video/' . $video->image);
                        if(!is_null($video->video_link)){
                             $itemVideo_link = $video->video_link;
                        }else(
                            $itemVideo_link = 'There is no video'
                        );
                    }
                } 
                if (!is_null($itemTitle)) {
                    $sectionDataItem['items'][] = [
                        'id' => $item->id,
                        'podcast_id' => $item->podcast_id,
                        'radio_id' => $item->radio_id,
                        'title' => $itemTitle,
                        'subtitle' => $itemSubTitle,
                        'image' => $itemImage_link,
                        'audio_link' => $itemAudio_link,
                        'video_link' => $itemVideo_link,
                        'item_type' => $itemType,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }
            }
            $response[] = $sectionDataItem;
        }

        $RadioRecords = Radio::where('status','active')->orderBy('created_at', 'desc')->get();
        
        foreach ($RadioRecords as $radio) {
            $radioData = [
                'id' => $radio->id,
                'title' => $radio->title,
                'subtitle' => $radio->subtitle,
                'image' => asset('image/radio/' . $radio->image),
            ];
            if (!is_null($radio->radio_file)) {
                $radioData['audio_link'] = asset('radio_file/' . $radio->radio_file);
            } elseif (!is_null($radio->radio_link)) {
                $radioData['audio_link'] = $radio->radio_link;
            } else {
                $radioData['audio_link'] = 'There is no radio';
            }
    
            $responseRadio[] = $radioData;
        }
        $sliders = Slider::where('status','active')->orderBy('created_at', 'desc')->get();

        foreach ($sliders as $slider) {
            $sliderData = [
                'id' => $slider->id,
                'title' => $slider->title,
                'slider_link' => $slider->slider_link,
                'image' => asset('image/slider/' . $slider->image),
            ];
          
            $responseSlider[] = $sliderData;
        }
        $banners = Banner::where('status','active')->orderBy('created_at', 'desc')->get();

        foreach ($banners as $banner) {
            $bannerData = [
                'id' => $banner->id,
                'title' => $banner->title,
                'banner_link' => $banner->banner_link,
                'subtitle' => $banner->subtitle,
                'image' => asset('image/banner/' . $banner->image),
            ];
          
            $responseBanner[] = $bannerData;
        }
        $setting = Settings::first();
        $setting['logo']  = asset('image/setting/' . $setting['logo']);
        $setting['favicon']  = asset('image/setting/' . $setting['favicon']);
        $setting['app_topber_logo']  = asset('image/setting/' . $setting['app_topber_logo']);
        $setting['whats_app_logo']  = asset('image/setting/' . $setting['whats_app_logo']);
        $setting['menu_bar_background']  = asset('image/setting/' . $setting['menu_bar_background']);
        $setting['phone_logo']  = asset('image/setting/' . $setting['phone_logo']);

        $menus = MenuBar::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($menus as $menu) {
            $menuData = [
                'id' => $menu->id,
                'name' => $menu->name,
                'link' => $menu->link,
                'image' => asset('image/menu_bar/' . $menu->image),
            ];
            $menusData[] = $menuData;
        }
       
        return response()->json([
            'message' => 'All Section With Item List:',
            'Radio data' => $responseRadio,
            'Slider Data' => $responseSlider,
            'Banner Data' => $responseBanner,
            'Section data' => $response,
            'Setting' => $setting,
            'Menu' => $menusData,
            
        ]);
    }


    public function bar($id=null)
    {
        $menus = MenuBar::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($menus as $menu) {
            $menuData = [
                'id' => $menu->id,
                'name' => $menu->name,
                'link' => $menu->link,
                'image' => asset('image/menu_bar/' . $menu->image),
            ];
            $response[] = $menuData;
        }
        $setting = Settings::first();
        $setting['logo']  = asset('image/setting/' . $setting['logo']);
        $setting['favicon']  = asset('image/setting/' . $setting['favicon']);
        $setting['app_topber_logo']  = asset('image/setting/' . $setting['app_topber_logo']);
        $setting['whats_app_logo']  = asset('image/setting/' . $setting['whats_app_logo']);
        $setting['phone_logo']  = asset('image/setting/' . $setting['phone_logo']);
        $setting['menu_bar_background']  = asset('image/setting/' . $setting['menu_bar_background']);

        if($id){
            $user = User::find($id);
            return response()->json([
                'message' => 'Manu List:',
                'data' => $response,
                'user' => $user,
                'setting' => $setting,
            ]);
        }
        return response()->json([
            'message' => 'Manu List:',
            'data' => $response,
            'setting' => $setting,

        ]);
    
    }
    public function settingIndexApi()
    {
        $setting = Settings::first();
        $setting['logo']  = asset('image/setting/' . $setting['logo']);
        $setting['favicon']  = asset('image/setting/' . $setting['favicon']);
        $setting['app_topber_logo']  = asset('image/setting/' . $setting['app_topber_logo']);
        $setting['whats_app_logo']  = asset('image/setting/' . $setting['whats_app_logo']);
        $setting['phone_logo']  = asset('image/setting/' . $setting['phone_logo']);
        $setting['menu_bar_background']  = asset('image/setting/' . $setting['menu_bar_background']);
        return response()->json([
            'message' => 'Setting:',
            'data' => $setting,
        ]);
    }



public function radioPodcastDevice($id, $podcast_id, $device)
    {
       if($podcast_id == '-9'){
        $radio = radio::where('status','active')->find($id);
    
        if (!$radio) {
            return response()->json('No Radio Exits');
        }
        if ($device == 1) {
            $radio->android_listener = $radio->android_listener + 1;
            $radio->connected_user = $radio->connected_user + 1;
            $radio->save();
        }else if ($device == 2) {
            $radio->ios_listener = $radio->ios_listener + 1;
            $radio->connected_user = $radio->connected_user + 1;
            $radio->save();
        }else if ($device == 0) {
            if ($radio->connected_user > 0) {
                $radio->connected_user = $radio->connected_user - 1;
                $radio->save();
            }
        } else {
            return response()->json([
                'message' => 'Radio Not Updated:',
                'data' => $radio,
            ]);
        }
        return response()->json([
            'message' => 'Radio Device Updated:',
            'data' => $radio,
        ]);
    }
 
        else if($id == '-9'){
            $podcast = Podcast::where('status','active')->find($podcast_id);
        
            if (!$podcast) {
                return response()->json('No Podcast Exits');
            }
            if ($device == 1) {
                $podcast->android_listener = $podcast->android_listener + 1;
                $podcast->connected_user = $podcast->connected_user + 1;
                $podcast->save();
            }else if ($device == 2) {
                $podcast->ios_listener = $podcast->ios_listener + 1;
                $podcast->connected_user = $podcast->connected_user + 1;
                $podcast->save();
            }else if ($device == 0) {
                if ($podcast->connected_user > 0) {
                    $podcast->connected_user = $podcast->connected_user - 1;
                    $podcast->save();
                }
            } else {
                return response()->json([
                    'message' => 'Podcast Not Updated:',
                    'data' => $podcast,
                ]);
            }
            return response()->json([
                'message' => 'Podcast Device Updated:',
                'data' => $podcast,
            ]);
        }else{return response()->json([
                'message' => '-9 Required in url, Updated Failed',
            ]);}
        
    }
    
}


