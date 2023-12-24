<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\PlaylistCategory;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Slider;
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
    $musics = PlaylistMusic::all();
    $playlist_catgory = PlaylistCategory::all();
    $podcast_catgory = PodcastCategory::all();

    return view('backend.admin.home.slider.process', compact('musics','podcasts','playlist_catgory','podcast_catgory'));
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

           }
      
           $slider->update($input);
           
           return redirect()->route('home.slider.index')->with('success', 'Slider Updated successfully.');

             
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
            
           }elseif($request->playlist_music_id){
            $input['slider_link'] = route('podcast.details.fetch', ['id' => $request->playlist_music_id]);
            $input['type'] ='music';
           }elseif($request->playlist_categorie_id){
            $input['slider_link'] =  $request->playlist_categorie_id;
            $input['type'] =  'playlist_category';
           }elseif( $request->podcast_categorie_id){
            $input['slider_link'] = $request->podcast_categorie_id;
            $input['type'] = 'podcast_category';
           }elseif( $request->custom_input){
            $input['slider_link'] = $request->custom_input;
            $input['type'] = 'link';
           }

           Slider::create($input);
           return redirect()->route('home.slider.index')->with('success', 'slider Added successfully.');
          }

      }


  public function homeSliderEdit($id)
  {
      $slider = Slider::find($id);
      return view('backend.admin.home.slider.process', ['slider' => $slider]);
  }


  public function homeSliderStatus(Request $request,$id)
  {
      $slider = Slider::find($id);
      $slider->status = $request->status;
        $slider->save();
        return redirect()->back();
  }
  
   public function homeSliderDestroy($id)
   {
       $slider = Slider::find($id);
       $slider->delete();
       return redirect()->back()->with('success', 'Slider Deleted Successfully.');
   }
}
