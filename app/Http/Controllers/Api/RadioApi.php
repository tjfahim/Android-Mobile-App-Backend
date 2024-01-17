<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
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

   
 
   
}
