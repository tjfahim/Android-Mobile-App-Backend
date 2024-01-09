<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatApi extends Controller
{
    public function ChatApi()
    {
        $chat = Chat::first();
        return response()->json([
            'message' => 'Setting:',
            'data' => $chat,
        ]);
    }
}
