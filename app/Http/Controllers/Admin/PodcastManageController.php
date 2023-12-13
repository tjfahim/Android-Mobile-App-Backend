<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PodcastManageController extends Controller
{
    public function podcastCatgoryIndex()
    {
        $podcastCatgory = PodcastCategory::orderBy('created_at', 'desc')->paginate(12);

        return view('backend.admin.podcast.category.index', ['podcastCatgories' => $podcastCatgory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function podcastCatgoryCreate()
    {
        return view('backend.admin.podcast.category.process');
    }
    /**
     * Store a newly created resource in storage.
     */

     public function podcastCatgoryProcess(Request $request, $id = null)
        {
            if ($id) {
                $podcastCatgory = PodcastCategory::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'string|max:255',
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
                    $destinationPath = 'podcast/image';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($podcastCatgory->image) {
                        unlink(public_path($destinationPath . $podcastCatgory->image));
                    }
                }
            
            
                $podcastCatgory->update($input);
                return redirect()->route('podcastcategory.index')->with('success', 'Category Updated successfully.');
               
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
                    $destinationPath = 'podcast/image/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
            
                PodcastCategory::create($input);
                return redirect()->route('podcastcategory.index')->with('success', 'Category Added successfully.');
            }

        }




    /**
     * Show the form for editing the specified resource.
     */
    public function podcastCatgoryEdit($id)
    {
        $podcastCatgory = PodcastCategory::find($id);
    
        if (!$podcastCatgory) {
            return redirect()->route('podcastcategory.index')->with('error', 'Podcast Category not found.');
        }
        return view('backend.admin.podcast.category.process', ['podcastcategory' => $podcastCatgory]);
    }


    public function podcastCatgoryDetails($id)
    {
        $podcastCatgory = PodcastCategory::find($id);
        $podcasts = Podcast::where('podcast_category_id', $podcastCatgory->id)->orderBy('created_at', 'desc')->paginate(12);
    
        if (!$podcastCatgory) {
            return redirect()->route('podcastcategory.index')->with('error', 'podcast Category not found.');
        }
        return view('backend.admin.podcast.category.details', ['podcastcategory' => $podcastCatgory,'podcasts' => $podcasts]);
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function podcastCatgorydestroy($id)
    {
        $podcastCatgory = PodcastCategory::find($id);
        $podcastCatgory->delete();
        return redirect()->route('podcastcategory.index')->with('success', 'podcast Category Deleted Successfully.');
    }

    public function podcastall()
    {
        $podcast = Podcast::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.podcast.podcast.index', ['podcast' => $podcast]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function podcastAdd(Request $request)
    {
        $podcast_category_id= $request->podcast_category_id;
        return view('backend.admin.podcast.podcast.process',['podcast_category_id' => $podcast_category_id]);
    }
 

    /**
     * Store a newly created resource in storage.
     */

     public function podcastPostPut(Request $request, $id = null)
        {
            if ($id) {
                $podcast = Podcast::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'audio_link' => 'nullable|url',
                    'video_link' => 'nullable|url',
                ]);
                if ($request->hasFile('image')) {
                    $validator->addRules([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                }
             
                if ($request->hasFile('audio')) {
                    $validator->addRules([
                        'audio' => 'file|mimes:mp3,wav|max:20480',
                    ]);
                }
                if ($request->hasFile('video')) {
                    $validator->addRules([
                        'video' => 'file|mimes:mp4,avi,mov',
                    ]);
                }
            
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
                $input = $request->all();
                if ($image = $request->file('image')) {
                    $destinationPath = 'podcast/image/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($podcast->image) {
                        unlink(public_path($destinationPath . $podcast->image));
                    }
                }
            
                if ($audio = $request->file('audio')) {
                    $destinationPath = 'podcast/audio/';
                    $originalFileName = $audio->getClientOriginalName(); 
                    $audioFileName = date('YmdHis') . "_" . $originalFileName; 
                    $audio->move($destinationPath, $audioFileName);
                    $input['audio'] = $audioFileName;
                    
                    if ($podcast->audio) {
                        unlink(public_path($destinationPath . $podcast->audio));
                    }
                }
                if ($video = $request->file('video')) {
                    $destinationPath = 'podcast/video/';
                    $originalFileName = $video->getClientOriginalName(); 
                    $videoFileName = date('YmdHis') . "_" . $originalFileName; 
                    $video->move($destinationPath, $videoFileName);
                    $input['video'] = $videoFileName;
                    
                    if ($podcast->video) {
                        unlink(public_path($destinationPath . $podcast->video));
                    }
                }
                $input['podcast_category_id'] = $request->podcast_category_id;

                $podcast->update($input);

                return redirect()->route('podcastcategory.details', ['id' => $request->podcast_category_id])->with('success', 'Podcast Updated successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'audio' => 'file|mimes:mp3,wav|max:20480',
                    'video' => 'file|mimes:mp4,avi,mov',
                    'video_link' => 'nullable|url',
                    'audio_link' => 'nullable|url',
                  
                ]);
        
        
                $validator->sometimes(['audio', 'audio_link'], 'required_without_all:audio,audio_link', 
                
                function ($input) {
                    return !$input->audio && !$input->audio_link;
                });

                $validator->sometimes(['video', 'video_link'], 'required_without_all:video,video_link', 
                
                function ($input) {
                    return !$input->video && !$input->video_link;
                });
          
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
                $input = $request->all();
           
                if ($image = $request->file('image')) {
                    $destinationPath = 'podcast/image/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
                $input['podcast_category_id'] = $request->podcast_category_id;
                if ($audio = $request->file('audio')) {
                    $destinationPath = 'podcast/audio/';
                    $originalFileName = $audio->getClientOriginalName(); 
                    $audioFileName = date('YmdHis') . "_" . $originalFileName; 
                    $audio->move($destinationPath, $audioFileName);
                    $input['audio'] = $audioFileName;
                }
                if ($video = $request->file('video')) {
                    $destinationPath = 'podcast/video/';
                    $originalFileName = $video->getClientOriginalName(); 
                    $videoFileName = date('YmdHis') . "_" . $originalFileName; 
                    $video->move($destinationPath, $videoFileName);
                    $input['video'] = $videoFileName;
                }
                
                Podcast::create($input);
                return redirect()->route('podcastcategory.details', ['id' => $request->podcast_category_id])->with('success', 'Podcast Added successfully.');

            }

        }




    /**
     * Show the form for editing the specified resource.
     */
    public function podcastEditpage(Request $request,$id)
    {
        $podcast = podcast::find($id);
        if (!$podcast) {
            return redirect()->route('podcast.index')->with('error', 'Podcast not found.');
        }
        $podcast_category_id= $request->podcast_category_id;
        return view('backend.admin.podcast.podcast.process',['podcast_category_id' => $podcast_category_id,'podcast' => $podcast]);
    
      }
    public function podcastDetails($id)
    {
        $podcast = podcast::find($id);
    
        if (!$podcast) {
            return redirect()->route('podcast.index')->with('error', 'Podcast not found.');
        }
        return view('backend.admin.podcast.podcast.details', ['podcast' => $podcast]);
    }

    public function podcastDestroy(Request $request,$id)
    {
        $podcast = podcast::find($id);
        $podcast->delete();
        return redirect()->route('podcastcategory.details', ['id' => $request->podcast_category_id])->with('success', 'Podcast deleted successfully.');

    }
}
