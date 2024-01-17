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
                'whats_app' => 'nullable',
                'phone' => 'nullable',
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
            if ($request->hasFile('whats_app_logo')) {
                $validator->addRules([
                    'whats_app_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($request->hasFile('phone_logo')) {
                $validator->addRules([
                    'phone_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($request->hasFile('menu_bar_background')) {
                $validator->addRules([
                    'menu_bar_background' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
            if ($whats_app_logo = $request->file('whats_app_logo')) {
                $destinationPath = 'image/setting';
                $originalFileName = $whats_app_logo->getClientOriginalName(); 
                $profilewhats_app_logo = date('YmdHis') . "_" . $originalFileName;
                $whats_app_logo->move($destinationPath, $profilewhats_app_logo);
                $input['whats_app_logo'] = $profilewhats_app_logo;
                
                if ($setting->whats_app_logo) {
                    $filePath = public_path($destinationPath . $setting->whats_app_logo);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            if ($phone_logo = $request->file('phone_logo')) {
                $destinationPath = 'image/setting';
                $originalFileName = $phone_logo->getClientOriginalName(); 
                $profilephone_logo = date('YmdHis') . "_" . $originalFileName;
                $phone_logo->move($destinationPath, $profilephone_logo);
                $input['phone_logo'] = $profilephone_logo;
                
                if ($setting->phone_logo) {
                    $filePath = public_path($destinationPath . $setting->phone_logo);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            if ($menu_bar_background = $request->file('menu_bar_background')) {
                $destinationPath = 'image/setting';
                $originalFileName = $menu_bar_background->getClientOriginalName(); 
                $profilemenu_bar_background = date('YmdHis') . "_" . $originalFileName;
                $menu_bar_background->move($destinationPath, $profilemenu_bar_background);
                $input['menu_bar_background'] = $profilemenu_bar_background;
                
                if ($setting->menu_bar_background) {
                    $filePath = public_path($destinationPath . $setting->menu_bar_background);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            
            $setting->update($input);
            return redirect()->route('settings.index')->with('success', 'Settings Updated Successfully.');
           
    }

}
