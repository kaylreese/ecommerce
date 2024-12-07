<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmin()
    {
        return User::select('users.*')
                ->where('is_admin', '=', 1)
                ->where('is_delete', '=', 0)
                ->orderBy('id', 'desc')
                ->get();
    }

    static public function getUser($id)
    {
        return User::find($id);
    }

    static public function checkEmail($email)
    {
        return User::select('users.*')
                ->where('email', '=', $email)
                ->first();
    }
    
    static public function getCustomers()
    {
        $customer = User::select('users.*');

            if (!empty(Request::get('name'))) {
                $customer = $customer->where('name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('email'))) {
                $customer = $customer->where('email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('state'))) {
                $customer = $customer->where('state', 'like', '%'.Request::get('state').'%');
            }
            if (!empty(Request::get('from_date'))) {
                $customer = $customer->whereDate('created_at', '>=', Request::get('from_date'));
            }
            if (!empty(Request::get('to_date'))) {
                $customer = $customer->whereDate('created_at', '<=', Request::get('to_date'));
            }

        $customer = $customer->where('status', '=', 1)
                ->where('is_admin', '!=', 1)
                ->where('is_delete', '=', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);

        return $customer;
    }

    static public function getCustomersTotal()
    {
        $data = self::select('id')->where('is_admin', '=', 0)->where('is_delete', '=', 0)->count();

        return $data;
    }
    
    static public function getCustomersTotalToday()
    {
        $data = self::select('id')->where('is_admin', '=', 0)->where('is_delete', '=', 0)->whereDate('created_at', '=', date('Y-m-d'))->count();

        return $data;
    }
     
    static public function getTotalCustomerMonth($start_date, $end_date)
    {
        return self::select('id')
                ->where('is_admin', '=', 0)
                ->where('is_delete', '=', 0)
                ->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->count();
    }
}
