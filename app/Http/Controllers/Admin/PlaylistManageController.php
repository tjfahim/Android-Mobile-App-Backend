<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlaylistCategory;
use App\Models\PlaylistCategoryMusic;
use App\Models\PlaylistMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PlaylistManageController extends Controller
{

    
    public function playlistIndex(Request $request)
    {
        $categories = PlaylistCategory::all();
        $musics = PlaylistMusic::all();

        
    $query = PlaylistCategoryMusic::query();

    // Apply category filter
    $filterCategory = $request->input('filter_category', 'all');
    if ($filterCategory != 'all') {
        $query->where('playlist_category_id', $filterCategory);
    }

    // Apply sorting based on user selection
    $sortBy = $request->input('sort_by', 'created_at');
    $sortOrder = $request->input('sort_order', 'desc');
    $query->orderBy($sortBy, $sortOrder);

    $playlists = $query->paginate(12);


        return view('backend.admin.playlist.index', compact('categories', 'musics','playlists'));
    }


    public function playlistCreate(Request $request)
    {
         $request->validate([
        'category' => 'required|exists:playlist_categories,id',
        'music' => 'required|exists:playlist_music,id',
    ]);


    $categoryId = $request->category;
    $musicId = $request->music;

    PlaylistCategoryMusic::create([
        'playlist_category_id' => $categoryId,
        'playlist_music_id' => $musicId,
    ]);

    return redirect()->route('playlist.index')->with('success', 'Playlist added successfully.');
}


    public function playlistDestroy($id)
    {
        $playlist = PlaylistCategoryMusic::find($id);
        $playlist->delete();
        return redirect()->back()->with('success', 'deleted successfully.');

    }

    public function playlistCatgoryIndex()
    {
        $playlistCatgory = PlaylistCategory::orderBy('created_at', 'desc')->paginate(12);

        return view('backend.admin.playlist.category.index', ['playlistCatgories' => $playlistCatgory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function playlistCatgoryCreate()
    {
        return view('backend.admin.playlist.category.process');
    }
    /**
     * Store a newly created resource in storage.
     */

     public function playlistCatgoryProcess(Request $request, $id = null)
        {
            if ($id) {
                $playlistCatgory = PlaylistCategory::find($id);
        
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
                    $destinationPath = 'image/playlist';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($playlistCatgory->image) {
                        unlink(public_path($destinationPath . $playlistCatgory->image));
                    }
                }
            
            
                $playlistCatgory->update($input);
                return redirect()->route('playlistcategory.index')->with('success', 'Category Updated successfully.');
               
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
                    $destinationPath = 'image/playlist';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
            
                PlaylistCategory::create($input);
                return redirect()->route('playlistcategory.index')->with('success', 'Category Added successfully.');
            }

        }




    /**
     * Show the form for editing the specified resource.
     */
    public function playlistCatgoryEdit($id)
    {
        $playlistCatgory = PlaylistCategory::find($id);
    
        if (!$playlistCatgory) {
            return redirect()->route('playlistcategory.index')->with('error', 'Playlist Category not found.');
        }
        return view('backend.admin.playlist.category.process', ['playlistcategory' => $playlistCatgory]);
    }
    public function playlistCatgoryDetails($id)
    {
        $playlistCatgory = PlaylistCategory::find($id);
    
        if (!$playlistCatgory) {
            return redirect()->route('playlistcategory.index')->with('error', 'Playlist Category not found.');
        }
        return view('backend.admin.playlist.category.details', ['playlistcategory' => $playlistCatgory]);
    }

    public function playlistcategoryStatus(Request $request, $id = null)
    {
            $playlistcategoryStatus = PlaylistCategory::find($id);
    
            $playlistcategoryStatus->status = $request->status;
            $playlistcategoryStatus->save();
            return redirect()->back();
  
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function playlistCatgorydestroy($id)
    {
        $playlistCatgory = PlaylistCategory::find($id);
        $playlistCatgory->delete();
        return redirect()->route('playlistcategory.index')->with('success', 'Playlist Category Deleted Successfully.');
    }

    public function playlistMusicIndex()
    {
        $playlistMusic = PlaylistMusic::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.playlist.music.index', ['playlistMusic' => $playlistMusic]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function playlistMusicCreate()
    {
        return view('backend.admin.playlist.music.process');
    }
 

    /**
     * Store a newly created resource in storage.
     */

     public function playlistMusicProcess(Request $request, $id = null)
        {
            if ($id) {
                $music = PlaylistMusic::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'music_link' => 'nullable|url',
                    'artist' => 'nullable|string|max:255',
                ]);
                if ($request->hasFile('image')) {
                    $validator->addRules([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                }
                if ($request->hasFile('feature_image')) {
                    $validator->addRules([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                }
                if ($request->hasFile('music_file')) {
                    $validator->addRules([
                        'music_file' => 'file|mimes:mp3,wav|max:20480',
                    ]);
                }
            
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
            
        
                $input = $request->all();
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/music';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($music->image) {
                        $filePath = public_path($destinationPath . $music->image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
            
                if ($feature_image = $request->file('feature_image')) {
                    $destinationPath = 'image/music';
                    $originalFileName = $feature_image->getClientOriginalName(); 
                    $profilefeature_image = date('YmdHis') . "_" . $originalFileName;
                    $feature_image->move($destinationPath, $profilefeature_image);
                    $input['feature_image'] = $profilefeature_image;
                    
                    if ($music->feature_image) {
                        $filePath = public_path($destinationPath . $music->feature_image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                
                }
            
                if ($music_file = $request->file('music_file')) {
                    $destinationPath = 'music_file/';
                    $originalFileName = $music_file->getClientOriginalName(); 
                    $music_fileFileName = date('YmdHis') . "_" . $originalFileName; 
                    $music_file->move($destinationPath, $music_fileFileName);
                    $input['music_file'] = $music_fileFileName;
                    
                    
                    if ($music->music_file) {
                        $filePath = public_path($destinationPath . $music->music_file);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
            
                $music->update($input);
                return redirect()->route('playlistmusic.index')->with('success', 'Music Updated successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'artist' => 'nullable|string|max:255',
                    'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'feature_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'music_file' => 'file|mimes:mp3,wav|max:20480',
                    'music_link' => 'nullable|url',
                  
                ]);
        
        
                $validator->sometimes(['music_file', 'music_link'], 'required_without_all:music_file,music_link', function ($input) {
                    return !$input->music_file && !$input->music_link;
                });
          
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $input = $request->all();
           
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/music';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
                if ($feature_image = $request->file('feature_image')) {
                    $destinationPath = 'image/music';
                    $originalFileName = $feature_image->getClientOriginalName(); 
                    $profilefeature_image = date('YmdHis') . "_" . $originalFileName;
                    $feature_image->move($destinationPath, $profilefeature_image);
                    $input['feature_image'] = $profilefeature_image;
                }
            
                if ($music_file = $request->file('music_file')) {
                    $destinationPath = 'music_file/';
                    $originalFileName = $music_file->getClientOriginalName(); 
                    $music_fileFileName = date('YmdHis') . "_" . $originalFileName; 
                    $music_file->move($destinationPath, $music_fileFileName);
                    $input['music_file'] = $music_fileFileName;
                }
                
                PlaylistMusic::create($input);
                return redirect()->route('playlistmusic.index')->with('success', 'Music Added successfully.');
            }

        }




    /**
     * Show the form for editing the specified resource.
     */
    public function playlistMusicEdit($id)
    {
        $playlistMusic = PlaylistMusic::find($id);
    
        if (!$playlistMusic) {
            return redirect()->route('playlistmusic.index')->with('error', 'Music not found.');
        }
        return view('backend.admin.playlist.music.process', ['playlistmusic' => $playlistMusic]);
    }
    public function playlistMusicDetails($id)
    {
        $playlistMusic = PlaylistMusic::find($id);
    
        if (!$playlistMusic) {
            return redirect()->route('playlistmusic.index')->with('error', 'Music not found.');
        }
        return view('backend.admin.playlist.music.details', ['playlistmusic' => $playlistMusic]);
    }

    /**
     * Update the specified resource in storage.
     */

     public function playlistStatus(Request $request, $id = null)
     {
             $playlistStatus = PlaylistMusic::find($id);
     
             $playlistStatus->status = $request->status;
             $playlistStatus->save();
             return redirect()->back();
   
     }

    /**
     * Remove the specified resource from storage.
     */
    public function playlistMusicDestroy($id)
    {
        $playlistMusic = PlaylistMusic::find($id);
        $playlistMusic->delete();
        return redirect()->route('playlistmusic.index')->with('success', 'Music deleted successfully.');

    }
}
