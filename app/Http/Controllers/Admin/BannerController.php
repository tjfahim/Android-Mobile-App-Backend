<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function BannerIndex()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.banner.index', ['banners' => $banners]);
    }
    public function bannerAdd(Request $request)
    {
        return view('backend.admin.banner.process');
    }
 
    /**
     * Store a newly created resource in storage.
     */

     public function bannerPostPut(Request $request, $id = null)
        {
            if ($id) {
                $banner = Banner::find($id);
        
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'banner_link' => 'nullable|url',
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
                    $destinationPath = 'image/banner/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;

                    if ($banner->image) {
                        $filePath = public_path($destinationPath . $banner->image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
            
                $input['status'] = $request->status;
                $banner->update($input);
                return redirect()->route('banner.index')->with('success', 'Banner Updated Successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'banner_link' => 'nullable|url',
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                
                $input = $request->all();
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/banner/';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }        
                banner::create($input);
                return redirect()->route('banner.index')->with('success', 'Banner Added Successfully.');

            }

        }
     public function bannerstatus(Request $request, $id = null)
        {
            $banner = banner::find($id);
    
            $banner->status = $request->status;
            $banner->save();
            return redirect()->back()->with('success', 'Status Change Successfully.');
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function bannerEditpage(Request $request,$id)
    {
        $banner = banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner not found.');
        }
        return view('backend.admin.banner.process',['banner' => $banner]);
    
      }
    public function bannerDetails($id)
    {
        $banner = banner::find($id);
    
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner not found.');
        }
        return view('backend.admin.banner.process', ['banner' => $banner]);
    }

    public function bannerDestroy(Request $request,$id)
    {
        $banner = banner::find($id);
        if ($banner->image) {
            $destinationPath = 'image/banner/';

            $filePath = public_path($destinationPath . $banner->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Banner Deleted Successfully.');

    }
 
}
