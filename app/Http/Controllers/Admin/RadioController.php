<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Radio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RadioController extends Controller
{
    public function index()
    {

        $RadioRecords = Radio::orderBy('created_at', 'desc')->paginate(12);

        return view('backend.admin.radio.index', ['RadioRecords' => $RadioRecords]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.radio.process');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function process(Request $request, $id = null)
        {
            if ($id) {
                $radio = Radio::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'radio_link' => 'nullable|url',
                ]);
                if ($request->hasFile('image')) {
                    $validator->addRules([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                }
                if ($request->hasFile('radio_file')) {
                    $validator->addRules([
                        'radio_file' => 'file|mimes:mp3,wav|max:20480',
                    ]);
                }
            
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
              

                
                // if ($request->has('radio_file') && $request->has('radio_link')) {
                //     $validator->errors()->add('radio_file', 'Only one of Link or radio File should be set');
                //     return Redirect::back()->withInput()->withErrors($validator);
                // }
                // if ($radio->radio_file && $request->has('radio_link')) {
                //     $validator->errors()->add('radio_file', 'Only one of Link or radio File should be set');
                //     return Redirect::back()->withInput()->withErrors($validator);
                // }
                // if ($request->has('radio_file') &&  $radio->radio_link) {
                //     $validator->errors()->add('radio_file', 'Only one of Link or radio File should be set');
                //     return Redirect::back()->withInput()->withErrors($validator);
                // }
        
            
        
                $input = $request->all();
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/radio/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($radio->image) {
                        $filePath = public_path($destinationPath . $radio->image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                 
                }
            
                if ($radio_file = $request->file('radio_file')) {
                    $destinationPath = 'radio_file/';
                    $originalFileName = $radio_file->getClientOriginalName(); 
                    $radio_fileFileName = date('YmdHis') . "_" . $originalFileName; 
                    $radio_file->move($destinationPath, $radio_fileFileName);
                    $input['radio_file'] = $radio_fileFileName;
                    
                    if ($radio->radio_file) {
                        unlink(public_path($destinationPath . $radio->radio_file));
                    }
                }
            
                $radio->update($input);
                return redirect()->route('radio.index')->with('success', 'Radio Updated successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'radio_file' => 'file|mimes:mp3,wav|max:20480',
                    'radio_link' => 'nullable|url',
                  
                ]);
        
        
                $validator->sometimes(['radio_file', 'radio_link'], 'required_without_all:radio_file,radio_link', function ($input) {
                    return !$input->radio_file && !$input->radio_link;
                });
          
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $input = $request->all();
           
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/radio/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
                if ($radio_file = $request->file('radio_file')) {
                    $destinationPath = 'radio_file/';
                    $originalFileName = $radio_file->getClientOriginalName(); 
                    $radio_fileFileName = date('YmdHis') . "_" . $originalFileName; 
                    $radio_file->move($destinationPath, $radio_fileFileName);
                    $input['radio_file'] = $radio_fileFileName;
                }
                
            
                Radio::create($input);
                return redirect()->route('radio.index')->with('success', 'Radio Added successfully.');
            }

            return redirect()->route('radio.index')->with('success', 'Radio processed successfully.');
        }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $radio = Radio::find($id);
    
        if (!$radio) {
            return redirect()->route('radio.index')->with('error', 'Radio not found.');
        }
        return view('backend.admin.radio.process', ['radio' => $radio]);
    }
    public function radioStatus(Request $request,$id)
    {
        $radioStatus = Radio::find($id);
    
        $radioStatus->status = $request->status;
        $radioStatus->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $radio = Radio::find($id);
        $radio->delete();
        return redirect()->route('radio.index')->with('success', 'Radio deleted successfully.');

    }
}
