<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function chatindex()
    {
        $chat = Chat::first();
        return view('backend.admin.chat.index', ['chat' => $chat]);
    }
 
    public function chatProcess(Request $request)
    {
            $chat = Chat::first();
            $validator = Validator::make($request->all(), [
                'video' => 'required|url',
                'chat' => 'required|url',
            ]);
         
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
            $chat->update($input);
            
            return redirect()->route('chat.index')->with('success', 'Video & Chat Updated successfully.');
           
    }
}
