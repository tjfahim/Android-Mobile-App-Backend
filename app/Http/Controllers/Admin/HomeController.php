<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventHome;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\PlaylistCategory;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function homeSectionIndex()
    {
        $homeSection = HomeSection::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.home.section', ['homeSections' => $homeSection]);
    }
    public function homeSectionDetails($id)
   {
       $homeSection = HomeSection::find($id);
       $home_section_id=$homeSection->id;
       $podcasts = Podcast::all();
       $musics = PlaylistMusic::all();
       $playlist_catgory = PlaylistCategory::all();
       $podcast_catgory = PodcastCategory::all();
       $sectionItems = HomeSectionItem::where('home_section_id',$homeSection->id)->get();

       return view('backend.admin.home.sectionDetails', compact('homeSection','musics','podcasts','sectionItems','home_section_id','playlist_catgory','podcast_catgory'));

   }
    public function homeSectionCreate()
    {
        return view('backend.admin.home.sectionProcess');
    }
   /**
    * Store a newly created resource in storage.
    */

    public function homeSectionProcess(Request $request, $id = null)
       {
           if ($id) {
            $homeSection = HomeSection::find($id);
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
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
                $destinationPath = 'image/home/';
                $originalFileName = $image->getClientOriginalName(); 
                $profileImage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;

            }
       
            $homeSection->update($input);
            
             return redirect()->route('home.section.index')->with('success', 'Home Section Updated successfully.');

              
           } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
       
            if ($image = $request->file('image')) {
                $destinationPath = 'image/home/';
                $originalFileName = $image->getClientOriginalName(); 
                $profileImage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;
            }
                       
            HomeSection::create($input);
            return redirect()->route('home.section.index')->with('success', 'Home Section Added successfully.');
           }

       }


   public function homeSectionEdit($id)
   {
       $homeSection = HomeSection::find($id);
       return view('backend.admin.home.sectionProcess', ['homeSection' => $homeSection]);
   }
   

   public function homeSectionItemCreate(Request $request,$home_section_id)
   {
       $validator = Validator::make($request->all(), [
           'podcast_id' => 'nullable|numeric',
           'podcast_categorie_id' => 'nullable|numeric',
           'playlist_categorie_id' => 'nullable|numeric',
           'playlist_music_id' => 'nullable|numeric',
       ]);
   
       if ($validator->fails()) {
           return redirect()
               ->back()
               ->withInput()
               ->withErrors($validator)
               ->with('error', 'Please select either Podcast or Music.');
       }
 
       $data = [
           'podcast_id' => $request->podcast_id,
           'playlist_music_id' => $request->playlist_music_id,
           'playlist_categorie_id' => $request->playlist_categorie_id,
           'podcast_categorie_id' => $request->podcast_categorie_id,
           'home_section_id' => $home_section_id,
       ];
       HomeSectionItem::create($data);
       return redirect()->back()->with('success', 'Added successfully.');
   }


   public function homeSectionItemDelete($id)
   {
       $homeSection = HomeSectionItem::find($id);
       $homeSection->delete();
       return redirect()->back()->with('success', 'Home Section Item Deleted Successfully.');
   }
  
   public function homeSectionDestroy($id)
   {
       $homeSection = HomeSection::find($id);
       $homeSection->delete();
       return redirect()->back()->with('success', 'Home Section Deleted Successfully.');
   }
   

   public function homeSectionStatus(Request $request, $id)
   {
           $homeSectionDestroy = HomeSection::find($id);
   
           $homeSectionDestroy->status = $request->status;
           $homeSectionDestroy->save();
           return redirect()->back();
 
   }

   public function homeSectionEventIndex()
   {
       $events = EventHome::orderBy('created_at', 'desc')->paginate(12);
       return view('backend.admin.home.event.section', ['events' => $events]);
   }
   public function homeSectionEventCreate()
   {
       return view('backend.admin.home.event.sectionProcess');
   }
   public function homeSectionEventProcess(Request $request, $id = null)
      {
          if ($id) {
           $event = EventHome::find($id);
           $validator = Validator::make($request->all(), [
               'title' => 'required|string|max:255',
               'event_link' => 'required|url',
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
               $destinationPath = 'image/event/';
               $originalFileName = $image->getClientOriginalName(); 
               $profileImage = date('YmdHis') . "_" . $originalFileName;
               $image->move($destinationPath, $profileImage);
               $input['image'] = $profileImage;

           }
      
           $event->update($input);
           
            return redirect()->route('home.section.event.index')->with('success', 'Event Updated successfully.');

             
          } else {
           $validator = Validator::make($request->all(), [
               'title' => 'required|string|max:255',
               'event_link' => 'required|url',
               'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
             
           ]);
   
           if ($validator->fails()) {
               return Redirect::back()->withInput()->withErrors($validator);
           }
           $input = $request->all();
      
           if ($image = $request->file('image')) {
               $destinationPath = 'image/event/';
               $originalFileName = $image->getClientOriginalName(); 
               $profileImage = date('YmdHis') . "_" . $originalFileName;
               $image->move($destinationPath, $profileImage);
               $input['image'] = $profileImage;
           }
                      
           EventHome::create($input);
           return redirect()->route('home.section.event.index')->with('success', 'Event Added successfully.');
          }

      }


  public function homeSectionEventEdit($id)
  {
      $event = EventHome::find($id);
      return view('backend.admin.home.event.sectionProcess', ['event' => $event]);
  }
  
  public function homeeventStatus(Request $request,$id)
  {
      $event = EventHome::find($id);
      $event->status = $request->status;
        $event->save();
        return redirect()->back();
  }
  
   public function homeSectionEventdestroy($id)
   {
       $event = EventHome::find($id);
       $event->delete();
       return redirect()->back()->with('success', 'Event Deleted Successfully.');
   }

}
