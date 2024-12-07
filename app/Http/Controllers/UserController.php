<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "Dashboard";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        
        return view('user.dashboard', $data);
    }

    public function orders()
    {
        $data['header_title'] = "Orders";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        
        return view('user.orders', $data);
    }

    public function edit_profile()
    {
        $data['header_title'] = "Edit Profile";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        
        return view('user.editprofile', $data);
    }
    
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        
        return view('user.changepassword', $data);
    }
}
