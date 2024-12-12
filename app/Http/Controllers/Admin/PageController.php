<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSettingModel;
use App\Models\PageModel;
use App\Models\SettingModel;
use App\Models\SMTPModel;
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

    public function home_settings()
    {
        $data['header_title'] = "Home Settings";
        $data['setting'] = HomeSettingModel::getSettings();

        return view('admin.homesettings', $data);
    }

    public function home_update_settings(Request $request)
    {
        $setting = HomeSettingModel::getSettings();
        $setting->trendy_product_title = trim($request->trendy_product_title);
        $setting->shop_category_title = trim($request->shop_category_title);
        $setting->recent_arrivals_title = trim($request->recent_arrivals_title);
        $setting->blog_title = trim($request->blog_title);
        $setting->payment_delivery = trim($request->payment_delivery);
        $setting->payment_delivery_description = trim($request->payment_delivery_description);
        $setting->refund_title = trim($request->refund_title);
        $setting->refund_description = trim($request->refund_description);
        $setting->support_title = trim($request->support_title);
        $setting->support_description = trim($request->support_description);
        $setting->singup_title = trim($request->singup_title);
        $setting->singup_description = trim($request->singup_description);

        $setting->payment_delivery_image = trim($request->payment_delivery_image);
        $setting->refund_image = trim($request->refund_image);
        $setting->support_image = trim($request->support_image);


        // if(!empty($request->hasFile('payment_delivery_image'))) {
        //     $file = $request->file('payment_delivery_image');
        //     $ext = $file->getClientOriginalExtension();
        //     $randomStr = $setting->id.Str::random(10);
        //     $filename = strtolower($randomStr).'.'.$ext;
        //     $file->move('public/upload/homesetting/', $filename);

        //     $setting->payment_delivery_image = $filename;
        // }
        
        // if(!empty($request->hasFile('refund_image'))) {
        //     $file2 = $request->file('refund_image');
        //     $ext = $file2->getClientOriginalExtension();
        //     $randomStr = $setting->id.Str::random(10);
        //     $filename2 = strtolower($randomStr).'.'.$ext;
        //     $file2->move('public/upload/homesetting/', $filename2);

        //     $setting->refund_image = $filename2;
        // }
        
        // if(!empty($request->hasFile('support_image'))) {
        //     $file4 = $request->file('support_image');
        //     $ext = $file4->getClientOriginalExtension();
        //     $randomStr = $setting->id.Str::random(10);
        //     $filename4 = strtolower($randomStr).'.'.$ext;
        //     $file4->move('public/upload/homesetting/', $filename4);

        //     $setting->support_image = $filename4;
        // }
        
        if(!empty($request->hasFile('singup_image'))) {
            $file3 = $request->file('singup_image');
            $ext = $file3->getClientOriginalExtension();
            $randomStr = $setting->id.Str::random(10);
            $filename3 = strtolower($randomStr).'.'.$ext;
            $file3->move('public/upload/homesetting/', $filename3);

            $setting->singup_image = $filename3;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Home Settings saved successfully!');
    }

    public function smtp_settings()
    {
        $data['header_title'] = "SMTP Settings";
        $data['setting'] = SMTPModel::getSettings();

        return view('admin.smtpsettings', $data);
    }

    public function smtp_update_settings(Request $request)
    {
        $setting = SMTPModel::getSettings();
        $setting->name = trim($request->name);
        $setting->mail_mailer = trim($request->mail_mailer);
        $setting->mail_host = trim($request->mail_host);
        $setting->mail_host = trim($request->mail_host);
        $setting->mail_port = trim($request->mail_port);
        $setting->mail_username = trim($request->mail_username);
        $setting->mail_password = trim($request->mail_password);
        $setting->mail_encryption = trim($request->mail_encryption);
        $setting->mail_from_address = trim($request->mail_from_address);
        $setting->save();

        return redirect()->back()->with('success', 'SMTP Settings saved successfully!');
    }
}
