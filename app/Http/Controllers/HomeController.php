<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactModel;
use App\Models\PageModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = PageModel::getUrl('home');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('home.index', $data);
    }


    public function contact() 
    {
        $page = PageModel::getUrl('contact');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;
        $data['setting'] = SettingModel::getSettings();

        return view('contact', $data);

    }
    
    public function save_contact(Request $request) 
    {
        $contact = new ContactModel();

        if(!empty(Auth::check())) {
            $contact->user_id = Auth::user()->id;
        }
        $contact->name = trim($request->name); 
        $contact->email = trim($request->email); 
        $contact->phone = trim($request->phone); 
        $contact->subject = trim($request->subject); 
        $contact->message = trim($request->message); 
        $contact->save();

        $settings = SettingModel::getSettings();

        Mail::to($settings->email)->send(new ContactMail($contact));

        return redirect()->back()->with('success', 'Your information successfully send.');

    }
    
    public function about() 
    {
        $page = PageModel::getUrl('about');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('about', $data);
    }

    public function faq() 
    {
        $page = PageModel::getUrl('faq');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('faq', $data);
    }

    public function payment_methods() 
    {
        $page = PageModel::getUrl('payment_methods');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('payment_methods', $data);
    }

    public function money_back_guarantee() 
    {
        $page = PageModel::getUrl('money_back_guarantee');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('money_back_guarantee', $data);
    }

    public function returns() 
    {
        $page = PageModel::getUrl('returns');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('returns', $data);
    }

    public function terms_conditions() 
    {
        $page = PageModel::getUrl('terms_conditions');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('terms_conditions', $data);
    }

    public function privacy_policy() 
    {
        $page = PageModel::getUrl('privacy_policy');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('privacy_policy', $data);
    }
    
    public function shipping() 
    {
        $page = PageModel::getUrl('shipping');
        $data['page'] = $page;

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('shipping', $data);
    }
}
