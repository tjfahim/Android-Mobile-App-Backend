<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function VideoIndex()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.video.index', ['videos' => $videos]);
    }
    public function VideoCreate()
    {
     return view('backend.admin.video.process');
    }
    public function VideoProcess(Request $request, $id = null)
       {
           if ($id) {
            $video = Video::find($id);
            $validator = Validator::make($request->all(), [
                'title' => 'nullable',
                'video_link' => 'required|url',
                'details' => 'nullable',
            ]);
            if ($request->hasFile('image')) {
                $validator->addRules([
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
            if ($image = $request->file('image')) {
                $destinationPath = 'image/video/';
                $originalFileName = $image->getClientOriginalName(); 
                $Videoimage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $Videoimage);
                $input['image'] = $Videoimage;
 
                if ($video->image) {
                    $filePath = public_path($destinationPath . $video->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
       
            $video->update($input);
            
            return redirect()->route('video.index')->with('success', 'Video Updated Successfully.');
              
           } else {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable',
                'video_link' => 'required|url',
                'details' => 'nullable',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
       
            if ($image = $request->file('image')) {
                $destinationPath = 'image/video/';
                $originalFileName = $image->getClientOriginalName(); 
                $Videoimage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $Videoimage);
                $input['image'] = $Videoimage;
            }
            Video::create($input);
            return redirect()->route('video.index')->with('success', 'Video Added Successfully.');
           }
 
       }
 
 
   public function VideoEdit($id)
   {
       $video = Video::find($id);
       return view('backend.admin.video.process', ['video' => $video]);
   }
 
 
   public function VideoStatus(Request $request,$id)
   {
       $video = Video::find($id);
       $video->status = $request->status;
         $video->save();
         return redirect()->back()->with('success', 'Status Change Successfully.');
   }
   
    public function VideoDestroy($id)
    {
        $video = Video::find($id);
        if ($video->image) {
            $destinationPath = 'image/video/';
            $filePath = public_path($destinationPath . $video->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $video->delete();
        return redirect()->back()->with('success', 'Video Deleted Successfully.');
    }
    public function videoDetails($id)
    {
        $video = Video::where('status','active')->find($id);
    
        if (!$video) {
            return response()->json('No Video Exits');
        }
            $imageName = $video->image;
            $imageUrl = asset('image/video/' . $imageName);
            $video->image = $imageUrl;
          
        return response()->json([
            'message' => 'video Details:',
            'data' => $video,
        ]);
    }
}
