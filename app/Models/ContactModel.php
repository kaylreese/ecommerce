<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ContactModel extends Model
{
    use HasFactory;

    protected $table = 'contact';

    static public function getContact($id)
    {
        return self::find($id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static public function getContacts() {
        $data = self::select('contact.*');

            if (!empty(Request::get('id'))) {
                $data = $data->where('id', '=', Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $data = $data->where('name', 'like', '%'.Request::get('name').'%');
            }

            if (!empty(Request::get('email'))) {
                $data = $data->where('email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('phone'))) {
                $data = $data->where('phone', 'like', '%'.Request::get('phone').'%');
            }
            if (!empty(Request::get('subject'))) {
                $data = $data->where('subject', 'like', '%'.Request::get('subject').'%');
            }
        
        $data = $data->orderBy('id', 'desc')->paginate(10);

        return $data;
    }
}
