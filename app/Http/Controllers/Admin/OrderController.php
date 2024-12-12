<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Mail\OrderStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationModel;

class OrderController extends Controller
{
    public function index()
    {
        $data['getOrders'] = OrderModel::getOrders();
        $data['header_title'] = "Orders";
        
        return view('admin.orders.index', $data);
    }

    public function show(string $id)
    {
        $data['order'] = OrderModel::getOrder($id);
        $data['header_title'] = "Order Detail";
        
        return view('admin.orders.detail', $data);
    }
    
    public function orders_status(Request $request)
    {
        $order = OrderModel::getOrder($request->order_id);
        $order->status = $request->status;
        $order->save();

        Mail::to($order->email)->send(new OrderStatusMail($order));

        $user_id = $order->user_id;
        $url = url('user/orders/'.$order->id);
        $message = 'Your Order Status Updated #'.$order->order_number;

        NotificationModel::insert($user_id, $url, $message);
        
        $data['message'] = "Status successfully update";

        echo json_encode($data);
    }

    public function destroy(string $id)
    {
        $product = OrderModel::find($id);    
        $product->status = 0;
        $product->save();

        return redirect()->back()->with('success', "Order Successfully Deleted");
    } 
}
