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
    
    public function banner_categoryIndex()
    {
        $banner_category = BannerCategory::orderBy('created_at', 'desc')->paginate(12);

        return view('backend.admin.banner.category.index', ['banner_category' => $banner_category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function banner_categoryCreate()
    {
        return view('backend.admin.banner.category.process');
    }
    /**
     * Store a newly created resource in storage.
     */

     public function banner_categoryProcess(Request $request, $id = null)
        {
            if ($id) {
                $banner_category = BannerCategory::find($id);
        
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
                    $destinationPath = 'image/banner';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                    
                    if ($banner_category->image) {
                        $filePath = public_path($destinationPath . $banner_category->image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                   
                }
            
                $banner_category->update($input);
                return redirect()->route('banner_category.index')->with('success', 'Category Updated Successfully.');
               
            } else {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                ]);
          
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $input = $request->all();
           
                if ($image = $request->file('image')) {
                    $destinationPath = 'image/banner';
                    $originalFileName = $image->getClientOriginalName(); 
                    $profileImage = date('YmdHis') . "_" . $originalFileName;
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = $profileImage;
                }
            
                BannerCategory::create($input);
                return redirect()->route('banner_category.index')->with('success', 'Category Added Successfully.');

            }

        }


        public function banner_categoryStatus(Request $request, $id = null)
        {
                $banner_category = BannerCategory::find($id);
        
                $banner_category->status = $request->status;
                $banner_category->save();
                return redirect()->back()->with('success', 'Status Change Successfully');
      
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function banner_categoryEdit($id)
    {
        $banner_categorydata = BannerCategory::find($id);
    
        if (!$banner_categorydata) {
            return redirect()->route('banner_category.index')->with('error', 'Banner Category not found.');
        }
    
        return view('backend.admin.banner.category.process', compact('banner_categorydata'));
    }
    


    public function banner_categoryDetails($id)
    {
        $banner_category = BannerCategory::find($id);
        $banners = Banner::where('banner_category_id', $banner_category->id)->orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.banner.category.details', ['banner_category' => $banner_category,'banners' => $banners]);
    }

    /**
     * Update the specified resource in storage.
     */

    
    /**
     * Remove the specified resource from storage.
     */
    public function banner_categorydestroy($id)
    {
        $banner_category = BannerCategory::find($id);
        $destinationPath = 'image/banner';
       
        if ($banner_category->image) {
            $filePath = public_path($destinationPath . $banner_category->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $banner_category->delete();
        return redirect()->route('banner_category.index')->with('success', 'Bannner Category Deleted Successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function bannerAdd(Request $request)
    {
        $banner_category_id= $request->banner_category_id;
        return view('backend.admin.banner.banner.process',['banner_category_id' => $banner_category_id]);
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
            
               
             
                $input['banner_category_id'] = $request->banner_category_id;
                $input['status'] = $request->status;

            
                $banner->update($input);

                return redirect()->route('banner_category.details', ['id' => $request->banner_category_id])->with('success', 'Banner Updated Successfully.');
               
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
                $input['banner_category_id'] = $request->banner_category_id;
        
                banner::create($input);
                return redirect()->route('banner_category.details', ['id' => $request->banner_category_id])->with('success', 'Banner Added Successfully.');

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
        $banner_category_id= $request->banner_category_id;
        return view('backend.admin.banner.banner.process',['banner_category_id' => $banner_category_id,'banner' => $banner]);
    
      }
    public function bannerDetails($id)
    {
        $banner = banner::find($id);
    
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner not found.');
        }
        return view('backend.admin.banner.banner.details', ['banner' => $banner]);
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
        return redirect()->route('banner_category.details', ['id' => $request->banner_category_id])->with('success', 'Banner Deleted Successfully.');

    }
 
}
