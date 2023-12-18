<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlaylistMusic;
use App\Models\Podcast;
use App\Models\RadioCustomCategory;
use App\Models\RadioCustomCategoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RadioDetailsManageController extends Controller
{
    
    public function RadioSectionIndex($radio_id)
    {
        $radioSection = RadioCustomCategory::where('radio_id',$radio_id)->orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.radio.radio_manage.radio_section.section', ['radioSection' => $radioSection,'radio_id' => $radio_id,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
     public function radioSectionCreate($radio_id)
     {
         return view('backend.admin.radio.radio_manage.radio_section.sectionProcess', ['radio_id' => $radio_id]);
     }
    /**
     * Store a newly created resource in storage.
     */

     public function radioSectionProcess(Request $request,$radio_id, $id = null)
        {
            if ($id) {
                $radioSection = RadioCustomCategory::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'string|max:255',
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
                $input = $request->all();                
             
                $radioSection->update($input);
                return redirect()->route('radio.section.index', ['radio_id' => $radio_id])->with('success', 'Radio Category Updated successfully.');
                return redirect()->route('radio.section.index', ['radio_id' => $radio_id])->with('success', 'Radio Section Added successfully.');

               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                ]);
          
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            
                $data = [
                    'title' => $request->title,
                    'radio_id' => $radio_id,
                    'status' => 'active',
                ];
                        
                RadioCustomCategory::create($data);
                return redirect()->route('radio.section.index', ['radio_id' => $radio_id])->with('success', 'Radio Section Added successfully.');
            }

        }




    /**
     * Show the form for editing the specified resource.
     */
    public function radioSectionEdit($radio_id,$id)
    {
        $radioSection = RadioCustomCategory::find($id);
        return view('backend.admin.radio.radio_manage.radio_section.sectionProcess', ['radioSection' => $radioSection,'radio_id' => $radio_id]);
    }
    public function radioSectionItemCreate(Request $request,$radio_custom_categorie_id)
    {
        $validator = Validator::make($request->all(), [
            'podcast_id' => 'nullable|numeric',
            'playlist_music_id' => 'nullable|numeric',
        ]);
    
        $validator->sometimes('podcast_id', 'required_without:playlist_music_id', function ($input) {
            return $input->filled('playlist_music_id');
        });
    
        $validator->sometimes('playlist_music_id', 'required_without:podcast_id', function ($input) {
            return $input->filled('podcast_id');
        });
    
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
            'radio_custom_categorie_id' => $radio_custom_categorie_id,
        ];
        RadioCustomCategoryItem::create($data);
        return redirect()->back()->with('success', 'Added successfully.');
    }
    public function radioSectionItemDelete($radioSectionItemId)
    {
        $radioSection = RadioCustomCategoryItem::find($radioSectionItemId);
        $radioSection->delete();
        return redirect()->back()->with('success', 'Radio Section Item Deleted Successfully.');
    }
    public function radioSectionDetails($radio_id,$id)
    {
        $radioSection = RadioCustomCategory::find($id);
        $radio_custom_categorie_id=$radioSection->id;
        $podcasts = Podcast::all();
        $musics = PlaylistMusic::all();
        $categoryItems = RadioCustomCategoryItem::where('radio_custom_categorie_id',$radioSection->id)->get();
        
    // $query = PlaylistCategoryMusic::query();

    // // Apply category filter
    // $filterCategory = $request->input('filter_category', 'all');
    // if ($filterCategory != 'all') {
    //     $query->where('playlist_category_id', $filterCategory);
    // }

    // // Apply sorting based on user selection
    // $sortBy = $request->input('sort_by', 'created_at');
    // $sortOrder = $request->input('sort_order', 'desc');
    // $query->orderBy($sortBy, $sortOrder);

    // $playlists = $query->paginate(12);


        return view('backend.admin.radio.radio_manage.radio_section.sectionDetails', compact('radioSection', 'radio_id','musics','podcasts','categoryItems','radio_custom_categorie_id'));
 
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function radioSectiondestroy($id)
    {
        $radioSection = RadioCustomCategory::find($id);
        $radioSection->delete();
        return redirect()->back()->with('success', 'Radio Section Deleted Successfully.');
    }
}
