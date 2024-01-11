<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MenuBarController extends Controller
{
    public function MenuBarIndex()
    {
        $bars = MenuBar::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.settings.menu_bar.index', ['bars' => $bars]);
    }
    public function MenuBarCreate()
    {
     return view('backend.admin.settings.menu_bar.process');
    }
    public function MenuBarProcess(Request $request, $id = null)
       {
           if ($id) {
            $bar = MenuBar::find($id);
            $validator = Validator::make($request->all(), [
                'link' => 'nullable|url',
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
                $destinationPath = 'image/menu_bar/';
                $originalFileName = $image->getClientOriginalName(); 
                $profileImage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;
 
                if ($bar->image) {
                    $filePath = public_path($destinationPath . $bar->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
       
            $bar->update($input);
            
            return redirect()->route('menu_bar.index')->with('success', 'Menu Updated Successfully.');
 
              
           } else {
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'link' => 'nullable|url',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
       
            if ($image = $request->file('image')) {
                $destinationPath = 'image/menu_bar/';
                $originalFileName = $image->getClientOriginalName(); 
                $profileImage = date('YmdHis') . "_" . $originalFileName;
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;
            }
            MenuBar::create($input);
            return redirect()->route('menu_bar.index')->with('success', 'Menu Added Successfully.');
           }
 
       }
 
 
   public function MenuBarEdit($id)
   {
       $bar = MenuBar::find($id);
       return view('backend.admin.settings.menu_bar.process', ['bar' => $bar]);
   }
 
 
   public function MenuBarStatus(Request $request,$id)
   {
       $bar = MenuBar::find($id);
       $bar->status = $request->status;
         $bar->save();
         return redirect()->back();
   }
   
    public function MenuBarDestroy($id)
    {
        $bar = MenuBar::find($id);
        $bar->delete();
        return redirect()->back()->with('success', 'Menu Deleted Successfully.');
    }
}
