<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $data['notifications'] = NotificationModel::getNotifications();
        $data['header_title'] = "Notifications";
        
        return view('admin.notifications.index', $data);
    }
}
