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
        return self::select('notifications.*', 'users.name', 'users.last_name')
                ->join('users', 'users.id', '=', 'notifications.user_id')
                ->where('notifications.status', '=', 1)
                ->orderBy('notifications.id', 'desc')
                ->paginate(10);
    }
    
    static public function getUnReadNotifications()
    {
        return self::select('notifications.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'notifications.user_id')
                ->where('notifications.is_read', '=', 0)
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

    static public function updateNotification($id)
    {
        $notification = NotificationModel::getNotification($id);

        if(!empty($notification))
        {
            $notification->is_read = 1;
            $notification->save();
        }
    }
}
