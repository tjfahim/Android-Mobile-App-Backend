<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveTv;
use Illuminate\Http\Request;

class LiveTvApi extends Controller
{
    public function liveTvIndexFetch()
    {
        $liveTvRecords = LiveTv::where('status','active')->orderBy('created_at', 'desc')->get();
        foreach ($liveTvRecords as $liveTv) {
            $liveTvData = [
                'id' => $liveTv->id,
                'title' => $liveTv->title,
                'chat_code_link' => $liveTv->chat_code_link,
                'embed_code_link' => $liveTv->embed_code_link,
                'image' => asset('image/live_tv/' . $liveTv->image),
            ];
         
            $response[] = $liveTvData;
        }
        return response()->json([
            'message' => 'LiveTv List:',
            'data' => $response,
        ]);
    }
}
