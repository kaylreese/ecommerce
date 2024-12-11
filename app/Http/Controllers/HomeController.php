<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\BlogModel;
use App\Models\Category;
use App\Models\ContactModel;
use App\Models\PageModel;
use App\Models\PartnerModel;
use App\Models\Product;
use App\Models\SettingModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\BlogCategoryModel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = PageModel::getUrl('home');
        $data['page'] = $page;

        $data["sliders"] = SliderModel::getSlidersActive();
        $data["partners"] = PartnerModel::getPartnersActive();
        $data["categories"] = Category::getCategoriesHome();
        $data["getProduct"] = Product::getRecentArrivals();
        $data["getProductTrendy"] = Product::getProductTrendy();

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('home.index', $data);
    }

    public function recent_arrivals_product(Request $request) {
        $getProduct = Product::getRecentArrivals();

        $categories = Category::getCategory($request->category_id);

        // dd($getProduct);

        return response()->json([
            'status' => true,
            'success' => view('product.list_recent_arrival', [
                'getProduct' => $getProduct,
                'categories' => $categories,
            ])->render(),
            ], 200);
    }


    public function contact() 
    {
        $page = PageModel::getUrl('contact');
        $data['page'] = $page;

        $first_number = mt_rand(0, 9);
        $second_number = mt_rand(0, 9);
        $data['first_number'] = $first_number;
        $data['second_number'] = $second_number;

        Session::put('total_sum', $first_number + $second_number);

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;
        $data['setting'] = SettingModel::getSettings();

        return view('contact', $data);

    }
    
    public function save_contact(Request $request) 
    {
        if (!empty($request->verification) && !empty(Session::get('total_sum'))) {
            if (trim(Session::get('total_sum')) == trim($request->verification)) {
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
            } else {
                return redirect()->back()->with('error', 'Your verification Sum is wrong.');
            }
        } else {
            return redirect()->back()->with('error', 'Your verification Sum is wrong.');
        }
        
        
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
    
    public function blog() 
    {
        $page = PageModel::getUrl('blog');
        $data['page'] = $page;
        $data['blogs'] = BlogModel::getBlogsHome();
        $data['categories'] = BlogCategoryModel::getCategories();

        $data['meta_title'] = $page->meta_title;
        $data['meta_keywords'] = $page->meta_keywords;
        $data['meta_description'] = $page->meta_description;

        return view('blog.index', $data);
    }
}
