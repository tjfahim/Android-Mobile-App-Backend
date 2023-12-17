<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RadioCustomCategory;
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
    public function radioSectionDetails($id)
    {
        $radioSection = RadioCustomCategory::find($id);

        return $radioSection;
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
