<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function settingindex()
    {
        $setting = Settings::first();
        return view('backend.admin.settings.index', ['setting' => $setting]);
    }
 
    public function settingProcess(Request $request)
    {
            $setting = Settings::first();
    
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'playstore_share_link' => 'nullable|url',
                'appstore_share_link' => 'nullable|url',
            ]);
            if ($request->hasFile('logo')) {
                $validator->addRules([
                    'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($request->hasFile('favicon')) {
                $validator->addRules([
                    'favicon' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($request->hasFile('app_topber_logo')) {
                $validator->addRules([
                    'app_topber_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
         
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $input = $request->all();
        
            if ($logo = $request->file('logo')) {
                $destinationPath = 'image/setting';
                $originalFileName = $logo->getClientOriginalName(); 
                $profilelogo = date('YmdHis') . "_" . $originalFileName;
                $logo->move($destinationPath, $profilelogo);
                $input['logo'] = $profilelogo;
                
                if ($setting->logo) {
                    $filePath = public_path($destinationPath . $setting->logo);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            
            }
            if ($favicon = $request->file('favicon')) {
                $destinationPath = 'image/setting';
                $originalFileName = $favicon->getClientOriginalName(); 
                $profilefavicon = date('YmdHis') . "_" . $originalFileName;
                $favicon->move($destinationPath, $profilefavicon);
                $input['favicon'] = $profilefavicon;
                
                if ($setting->favicon) {
                    $filePath = public_path($destinationPath . $setting->favicon);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            
            }
        
            if ($app_topber_logo = $request->file('app_topber_logo')) {
                $destinationPath = 'image/setting';
                $originalFileName = $app_topber_logo->getClientOriginalName(); 
                $profileapp_topber_logo = date('YmdHis') . "_" . $originalFileName;
                $app_topber_logo->move($destinationPath, $profileapp_topber_logo);
                $input['app_topber_logo'] = $profileapp_topber_logo;
                
                if ($setting->app_topber_logo) {
                    $filePath = public_path($destinationPath . $setting->app_topber_logo);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            
            }
        
            $setting->update($input);
            return redirect()->route('settings.index')->with('success', 'Settings Updated Successfully.');
           
    }

}
