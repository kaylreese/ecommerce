<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['header_title'] = "Dashboard";
        $data['totalorders'] = OrderModel::getTotalOrders();
        $data['totalorderstoday'] = OrderModel::getTotalOrdersToday();
        $data['totalamount'] = OrderModel::getTotalAmount();
        $data['totalamounttoday'] = OrderModel::getTotalAmountToday();
        $data['totalcustomer'] = User::getCustomersTotal();
        $data['totalcustomertoday'] = User::getCustomersTotalToday();
        
        $data['getLatestOrders'] = OrderModel::getLatestOrders();

        // dd($request->all());

        if (!empty($request->year)) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }
        

        $totalCustomerMonth = '';
        $totalOrderMonth = '';
        $totalOrderAmountMonth = '';

        $totalAmount = 0;

        for($month = 1; $month<=12; $month++){
            $startDate = new \DateTime("$year-$month-01");
            $endDate = new \DateTime("$year-$month-01");
            $endDate->modify('Last Day of this month');

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            $customer = User::getTotalCustomerMonth($start_date, $end_date);
            $totalCustomerMonth .= $customer.',';
            $orders = OrderModel::TotalOrderMonth($start_date, $end_date);
            $totalOrderMonth .= $orders.',';
            $orderpayment = OrderModel::getTotalOrderAmountMonth($start_date, $end_date);
            $totalOrderAmountMonth .= $orderpayment.',';
            $totalAmount = $orderpayment + $orderpayment;
        }

        $data['totalCustomerMonth'] = rtrim($totalCustomerMonth, ',');
        $data['totalOrderMonth'] = rtrim($totalOrderMonth, ',');
        $data['totalOrderAmountMonth'] = rtrim($totalOrderAmountMonth, ',');
        $data['totalAmount'] = $totalAmount;
        $data['year'] = $year;
        
        return view('admin.dashboard', $data);
    }
}
