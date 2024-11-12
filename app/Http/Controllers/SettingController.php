<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index',compact('setting'));
    }





   public function store(Request $request){

        // dd($request->all());
        $setting = Setting::first();
        
        if($setting){
         $data = [
            'website_name' => $request->website_name,
            'website_url' => $request->website_url,
            'page_title' => $request->page_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email1' => $request->email1,
            'email2' => $request->email2,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram
            // 'youtube' => $request-> youtube,
            
         ];
            
          
         if($request->hasFile('website_logo'))
         {
            $destination = 'files/';
            $file = $request->file('website_logo');
            $fileName = fileUpload($file, $destination);
            $data['website_logo'] = $fileName;
         }
               
              
         $setting->update($data);

           

          return redirect()->back()->with('message', 'Settings Saved');

        }else{
         $data = [
            'website_name' => $request->website_name,
            'website_url' => $request->website_url,
            'page_title' => $request->page_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email1' => $request->email1,
            'email2' => $request->email2,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram
            // 'youtube' => $request-> youtube,
         ];
               $destination = 'files/';
               $file = $request->file('website_logo');
               $fileName = fileUpload($file, $destination);
               $data['website_logo'] = $fileName;
               
         setting::create($data);

         return redirect()->back()->with('message', 'Settings Saved');

        }
   }
}