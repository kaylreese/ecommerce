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
        return self::select('*')
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
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

    static public function getNotificationsUser($user_id)
    {
        return self::select('*')
                ->where('user_id', '=', $user_id)
                ->orderBy('id', 'desc')
                ->paginate(40);
    }

    static public function getUnReadNotificationsCount($user_id)
    {
        return self::select('*')
                ->where('user_id', '=', $user_id)
                ->where('is_read', '=', 0)
                ->orderBy('id', 'desc')
                ->count();
    }
}
