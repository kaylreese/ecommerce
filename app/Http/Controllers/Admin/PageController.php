<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $data['pages'] = PageModel::getPages();
        $data['header_title'] = "Pages";
        
        return view('admin.page.index', $data);
    }

    public function edit(string $id)
    {
        $data['page'] = PageModel::getPage($id);
        $data['header_title'] = "Edit Page";
        
        return view('admin.page.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $page = PageModel::getPage($id);
        $page->name = trim($request->name);
        $page->url = trim($request->url);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_keywords = trim($request->meta_keywords);
        $page->meta_description = trim($request->meta_description);
        $page->state = trim($request->state);
        $page->save();

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('upload/page/', $filename);
        
            $page->image_name = $filename;
            $page->save();
        }

        return redirect('admin/page')->with('success', "Page Successfully Updated");
    }

    public function settings()
    {
        $data['header_title'] = "System Settings";
        $data['setting'] = SettingModel::getSettings();

        return view('admin.settings', $data);
    }
    
    public function update_settings(Request $request)
    {
        // dd($request->all());
        $setting = SettingModel::getSettings();
        $setting->website_name = $request->website_name;
        $setting->footer_description = $request->footer_description;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->phone2 = $request->phone2;
        $setting->email = $request->email;
        $setting->email2 = $request->email2;
        $setting->working_hours = $request->working_hours;
        $setting->facebook_link = $request->facebook_link;
        $setting->twitter_link = $request->twitter_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->youtube_link = $request->youtube_link;
        $setting->pinterest_link = $request->pinterest_link;

        if(!empty($request->hasFile('logo'))) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $setting->id.Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/upload/setting/', $filename);

            $setting->logo = $filename;
        }
        
        if(!empty($request->hasFile('favicon'))) {
            $file2 = $request->file('favicon');
            $ext = $file2->getClientOriginalExtension();
            $randomStr = $setting->id.Str::random(10);
            $filename2 = strtolower($randomStr).'.'.$ext;
            $file2->move('public/upload/setting/', $filename2);

            $setting->favicon = $filename2;
        }
        
        if(!empty($request->hasFile('footer_logo'))) {
            $file4 = $request->file('footer_logo');
            $ext = $file4->getClientOriginalExtension();
            $randomStr = $setting->id.Str::random(10);
            $filename4 = strtolower($randomStr).'.'.$ext;
            $file4->move('public/upload/setting/', $filename4);

            $setting->footer_logo = $filename4;
        }
        
        if(!empty($request->hasFile('footer_payment_icon'))) {
            $file3 = $request->file('footer_payment_icon');
            $ext = $file3->getClientOriginalExtension();
            $randomStr = $setting->id.Str::random(10);
            $filename3 = strtolower($randomStr).'.'.$ext;
            $file3->move('public/upload/setting/', $filename3);

            $setting->footer_payment_icon = $filename3;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }
}
