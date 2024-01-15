<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\Radio;
use App\Models\Slider;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{

   public function homeSliderIndex()
   {
       $sliders = Slider::orderBy('created_at', 'desc')->paginate(12);
       return view('backend.admin.home.slider.index', ['sliders' => $sliders]);
   }
   public function homeSliderCreate()
   {
    $podcasts = Podcast::all();
    $radios = Radio::all();
    $videos = Video::all();

    return view('backend.admin.home.slider.process', compact('radios','podcasts','videos'));
   }
   public function homeSliderProcess(Request $request, $id = null)
      {
          if ($id) {
           $slider = Slider::find($id);
           $validator = Validator::make($request->all(), [
               'slider_link' => 'nullable|url',
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
                $destinationPath = 'image/slider/';
                $originalFileName = $image->getClientOriginalName(); 
                $profileImage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;

                if ($slider->image) {
                    $filePath = public_path($destinationPath . $slider->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
      
           $slider->update($input);
           
           return redirect()->route('home.slider.index')->with('success', 'Slider Updated Successfully.');

             
          } else {
           $validator = Validator::make($request->all(), [
               'title' => 'string|max:255',
               'slider_link' => 'nullable|url',
               'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
             
           ]);
   
           if ($validator->fails()) {
               return Redirect::back()->withInput()->withErrors($validator);
           }
           $input = $request->all();
      
           if ($image = $request->file('image')) {
               $destinationPath = 'image/slider/';
               $originalFileName = $image->getClientOriginalName(); 
               $profileImage = date('YmdHis') . "_" . $originalFileName;
               $image->move($destinationPath, $profileImage);
               $input['image'] = $profileImage;
           }
           
           if ( $request->podcast_id) {
            $input['slider_link'] = route('podcastDetails', ['id' => $request->podcast_id]);
            $input['type'] = 'podcast';
           }elseif($request->radio_id){
            $input['slider_link'] = route('radioDetails', ['id' => $request->radio_id]);
            $input['type'] ='radio';
           }elseif($request->video_id){
            $input['slider_link'] =  route('videoDetails', ['id' => $request->video_id]);
            $input['type'] =  'video';
           }elseif( $request->custom_input){
            $input['slider_link'] = $request->custom_input;
            $input['type'] = 'link';
           }

           Slider::create($input);
           return redirect()->route('home.slider.index')->with('success', 'slider Added Successfully.');
          }
      }


  public function homeSliderEdit($id)
  {
      $slider = Slider::find($id);
      $podcasts = Podcast::all();
      $radios = Radio::all();
      $videos = Video::all();
  
      return view('backend.admin.home.slider.process', compact('radios','podcasts','videos','slider'));
  }


  public function homeSliderStatus(Request $request,$id)
  {
      $slider = Slider::find($id);
      $slider->status = $request->status;
        $slider->save();
        return redirect()->back()->with('success', 'Status Change Successfully.');
  }
  
    public function homeSliderDestroy($id)
    {
        $slider = Slider::find($id);
        $destinationPath = 'image/slider/';
        if ($slider->image) {
            $filePath = public_path($destinationPath . $slider->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $slider->delete();
        return redirect()->route('home.slider.index')->with('success', 'Slider Deleted Successfully.');
    }
}
