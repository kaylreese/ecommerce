<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "Dashboard";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        $data['totalorders'] = OrderModel::getTotalOrdersUser(Auth::user()->id);
        $data['totalorderstoday'] = OrderModel::getTotalOrdersTodayUser(Auth::user()->id);
        $data['totalamount'] = OrderModel::getTotalAmountUser(Auth::user()->id);
        $data['totalamounttoday'] = OrderModel::getTotalAmountTodayUser(Auth::user()->id);

        $data['totalPending'] = OrderModel::getTotalStatusUser(Auth::user()->id, 0);
        $data['totalInprogress'] = OrderModel::getTotalStatusUser(Auth::user()->id, 1);
        $data['totalCompleted'] = OrderModel::getTotalStatusUser(Auth::user()->id, 3);
        $data['totalCancelled'] = OrderModel::getTotalStatusUser(Auth::user()->id, 4);
        
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
