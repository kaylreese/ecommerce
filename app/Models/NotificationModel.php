<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    static public function getNotifications()
    {
        return self::select('notifications.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'notifications.user_id')
                ->where('notifications.status', '=', 1)
                ->orderBy('notifications.id', 'desc')
                ->paginate(10);
    }

    static public function insert($user_id, $url, $message)
    {
        $notification = new NotificationModel();
        $notification->user_id = $user_id;
        $notification->url = $url;
        $notification->message = $message;
        $notification->save();
    }

    static public function getNotification($id)
    {
        return self::find($id);
    }

    static public function checkUrl($url)
    {
        return self::where('url', '=', $url)->get();
    }
}
