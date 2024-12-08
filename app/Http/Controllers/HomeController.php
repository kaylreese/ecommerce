<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['meta_title'] = 'E-Commerce';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('home.index', $data);
    }


    public function contact() 
    {
        $data['meta_title'] = 'Contact';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('contact', $data);

    }
    
    public function about() 
    {
        $data['meta_title'] = 'About us';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('about', $data);
    }

    public function faq() 
    {
        $data['meta_title'] = 'FAQ';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('faq', $data);
    }

    public function payment_methods() 
    {
        $data['meta_title'] = 'Payment Methods';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('payment_methods', $data);
    }

    public function money_back_guarantee() 
    {
        $data['meta_title'] = 'Money Back Guarantee';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('money_back_guarantee', $data);
    }

    public function returns() 
    {
        $data['meta_title'] = 'Return';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('returns', $data);
    }

    public function terms_conditions() 
    {
        $data['meta_title'] = 'Terms Conditions';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('terms_conditions', $data);
    }

    public function privacy_policy() 
    {
        $data['meta_title'] = 'Privacy Policy';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('privacy_policy', $data);
    }
    
    public function shipping() 
    {
        $data['meta_title'] = 'Shipping';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        return view('shipping', $data);
    }
}
