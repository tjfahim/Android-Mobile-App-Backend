<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveTv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LiveTvController extends Controller
{
    public function LiveTvIndex()
    {
        $live_tvs = LiveTv::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.live_tv.index', ['live_tvs' => $live_tvs]);
    }
    public function LiveTvCreate()
    {
     return view('backend.admin.live_tv.process');
    }
    public function LiveTvProcess(Request $request, $id = null)
       {
           if ($id) {
            $live_tv = LiveTv::find($id);
            $validator = Validator::make($request->all(), [
                'title' => 'nullable',
                'chat_code_link' => 'nullable|url',
                'embed_code_link' => 'nullable|url',
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
                $destinationPath = 'image/live_tv/';
                $originalFileName = $image->getClientOriginalName(); 
                $liveTvimage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $liveTvimage);
                $input['image'] = $liveTvimage;
 
                if ($live_tv->image) {
                    $filePath = public_path($destinationPath . $live_tv->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
       
            $live_tv->update($input);
            
            return redirect()->route('live_tv.index')->with('success', 'Live TV Updated Successfully.');
              
           } else {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable',
                'chat_code_link' => 'nullable|url',
                'embed_code_link' => 'nullable|url',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
       
            if ($image = $request->file('image')) {
                $destinationPath = 'image/live_tv/';
                $originalFileName = $image->getClientOriginalName(); 
                $liveTvimage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $liveTvimage);
                $input['image'] = $liveTvimage;
            }
            LiveTv::create($input);
            return redirect()->route('live_tv.index')->with('success', 'Live TV Added Successfully.');
           }
 
       }
 
 
   public function LiveTvEdit($id)
   {
       $live_tv = LiveTv::find($id);
       return view('backend.admin.live_tv.process', ['live_tv' => $live_tv]);
   }
 
 
   public function LiveTvStatus(Request $request,$id)
   {
       $live_tv = LiveTv::find($id);
       $live_tv->status = $request->status;
         $live_tv->save();
         return redirect()->back()->with('success', 'Status Change Successfully.');
   }
   
    public function LiveTvDestroy($id)
    {
        $live_tv = LiveTv::find($id);
        if ($live_tv->image) {
            $destinationPath = 'image/live_tv/';
            $filePath = public_path($destinationPath . $live_tv->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $live_tv->delete();
        return redirect()->back()->with('success', 'Live TV Deleted Successfully.');
    }
}
