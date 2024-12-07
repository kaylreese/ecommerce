<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\User;
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

        $data['orders'] = OrderModel::getOrdersUser(Auth::user()->id);
        
        return view('user.orders', $data);
    }

    public function order_detail(string $id)
    {
        $data['order'] = OrderModel::getOrderUser(Auth::user()->id, $id);
        if (!empty($data['order'])) {
            $data['header_title'] = "Order Detail";
            $data['meta_keywords'] = '';
            $data['meta_description'] = '';
            
            return view('user.detail', $data);
        } else {
            abort(404);
        }
        
        
    }

    public function edit_profile()
    {
        $data['header_title'] = "Edit Profile";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        $data['user'] = User::getUser(Auth::user()->id);
        
        return view('user.editprofile', $data);
    }
    
    public function update_profile(Request $request)
    {
        $user = User::getUser(Auth::user()->id);
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->company_name = trim($request->company_name);
        $user->country = trim($request->country);
        $user->address_one = trim($request->address_one);
        $user->address_two = trim($request->address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->postcode = trim($request->postcode);
        $user->phone = trim($request->phone);
        $user->save();
        
        return redirect()->back()->with('success', 'Profile successfully updated');
    }
    
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        
        return view('user.changepassword', $data);
    }
}
