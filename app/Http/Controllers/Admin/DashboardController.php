<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "Dashboard";
        $data['totalorders'] = OrderModel::getTotalOrders();
        $data['totalorderstoday'] = OrderModel::getTotalOrdersToday();
        $data['totalamount'] = OrderModel::getTotalAmount();
        $data['totalamounttoday'] = OrderModel::getTotalAmountToday();
        $data['totalcustomer'] = User::getCustomersTotal();
        $data['totalcustomertoday'] = User::getCustomersTotalToday();
        
        $data['getLatestOrders'] = OrderModel::getLatestOrders();
        
        return view('admin.dashboard', $data);
    }
}
