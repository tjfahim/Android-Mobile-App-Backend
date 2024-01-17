<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\Podcast;
use App\Models\Radio;
use App\Models\Video;
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
       $podcasts = Podcast::where('status','active')->get();
       $videos = Video::where('status','active')->get();
       $radios = Radio::where('status','active')->get();
    
       $sectionItems = HomeSectionItem::where('home_section_id',$homeSection->id)->get();

       return view('backend.admin.home.sectionDetails', compact('homeSection','podcasts','sectionItems','home_section_id','videos','radios'));

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

                if ($homeSection->image) {
                    $filePath = public_path($destinationPath . $homeSection->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
       
            $homeSection->update($input);
            
             return redirect()->route('home.section.index')->with('success', 'Home Section Updated Successfully.');
              
           } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
              
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
            return redirect()->route('home.section.index')->with('success', 'Home Section Added Successfully.');
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
           'radio_id' => 'nullable|numeric',
           'video_id' => 'nullable|numeric',
       ]);
   
       if ($validator->fails()) {
           return redirect()
               ->back()
               ->withInput()
               ->withErrors($validator)
               ->with('error', 'Please select Only One');
       }
 
       $data = [
           'podcast_id' => $request->podcast_id,
           'radio_id' => $request->radio_id,
           'video_id' => $request->video_id,
           'home_section_id' => $home_section_id,
       ];
       HomeSectionItem::create($data);
       return redirect()->back()->with('success', 'Added Successfully.');
   }


   public function homeSectionItemDelete($id)
   {
       $homeSection = HomeSectionItem::find($id);
       $destinationPath = 'image/home/';
      
       if ($homeSection->image) {
           $filePath = public_path($destinationPath . $homeSection->image);
           if (file_exists($filePath)) {
               unlink($filePath);
           }
       }
       $homeSection->delete();
       return redirect()->back()->with('success', 'Home Section Item Deleted Successfully.');
   }
  
   public function homeSectionDestroy($id)
   {
       $homeSection = HomeSection::find($id);
       $homeSection->delete();
       return redirect()->route('home.section.index')->with('success', 'Home Section Deleted Successfully.');
   }
   

   public function homeSectionStatus(Request $request, $id)
   {
           $homeSectionDestroy = HomeSection::find($id);
   
           $homeSectionDestroy->status = $request->status;
           $homeSectionDestroy->save();
           return redirect()->back()->with('success', 'Status Change Successfully.');
 
   }

}
