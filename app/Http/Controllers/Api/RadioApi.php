<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Radio;
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
            ];
            if (!is_null($radio->radio_link)) {
                $radioData['audio_link'] = $radio->radio_link;
            } elseif (!is_null($radio->radio_file)) {
                $radioData['audio_link'] = asset('radio_file/' . $radio->radio_file);
            } else {
                $radioData['audio_link'] = 'There is no radio';
            }
            $response[] = $radioData;
        }
        return response()->json([
            'message' => 'Radio List:',
            'data' => $response,
        ]);
    }

    public function radioLiveDevice($id,$device)
    {
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
 
   
}
