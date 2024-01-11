<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoReel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VideoReelController extends Controller
{
    public function VideoReelIndex()
    {
        $reels = VideoReel::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.reel.index', ['reels' => $reels]);
    }
    public function VideoReelCreate()
    {
     return view('backend.admin.reel.process');
    }
    public function VideoReelProcess(Request $request, $id = null)
       {
           if ($id) {
            $reel = VideoReel::find($id);
            $validator = Validator::make($request->all(), [
                'video_link' => 'nullable|url',
                'title' => 'string',
                'subtitle' => 'string',
            ]);
          
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
        
            $reel->update($input);
            
            return redirect()->route('reel.index')->with('success', 'Reel Updated Successfully.');
 
              
           } else {
            $validator = Validator::make($request->all(), [
                'title' => 'string|max:255',
                'subtitle' => 'string|max:255',
                'video_link' => 'nullable|url',
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
            $input['favourite'] = '0';
            VideoReel::create($input);
            return redirect()->route('reel.index')->with('success', 'Reel Added Successfully.');
           }
 
       }
 
 
   public function VideoReelEdit($id)
   {
       $reel = VideoReel::find($id);
       return view('backend.admin.reel.process', ['reel' => $reel]);
   }
 
 
   public function VideoReelStatus(Request $request,$id)
   {
       $reel = VideoReel::find($id);
       $reel->status = $request->status;
         $reel->save();
         return redirect()->back();
   }

   
    public function VideoReelDestroy($id)
    {
        $reel = VideoReel::find($id);
        $reel->delete();
        return redirect()->route('reel.index')->with('success', 'Reel Deleted Successfully.');
    }
}
