<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getOrder($id) {
        return self::find($id);
    }

    static public function getOrders() {
        $data = self::select('orders.*');

            if (!empty(Request::get('id'))) {
                $data = $data->where('id', '=', Request::get('id'));
            }
            if (!empty(Request::get('company_name'))) {
                $data = $data->where('company_name', 'like', '%'.Request::get('company_name').'%');
            }
            if (!empty(Request::get('first_name'))) {
                $data = $data->where('first_name', 'like', '%'.Request::get('first_name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $data = $data->where('last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('email'))) {
                $data = $data->where('email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('phone'))) {
                $data = $data->where('phone', 'like', '%'.Request::get('phone').'%');
            }
            if (!empty(Request::get('country'))) {
                $data = $data->where('country', 'like', '%'.Request::get('country').'%');
            }
            if (!empty(Request::get('city'))) {
                $data = $data->where('city', 'like', '%'.Request::get('city').'%');
            }
            if (!empty(Request::get('state'))) {
                $data = $data->where('state', 'like', '%'.Request::get('state').'%');
            }
            if (!empty(Request::get('postcode'))) {
                $data = $data->where('postcode', 'like', '%'.Request::get('postcode').'%');
            }
            if (!empty(Request::get('from_date'))) {
                $data = $data->whereDate('created_at', '>=', Request::get('from_date'));
            }
            if (!empty(Request::get('to_date'))) {
                $data = $data->whereDate('created_at', '<=', Request::get('to_date'));
            }
        
        $data = $data->where('is_payment', '=', 1)->where('deleted', '=', 0)->orderBy('id', 'desc')->paginate(10);

        return $data;
    }

    public function shipping()
    {
        return $this->belongsTo(ShippingChargeModel::class, 'shipping_id');
    }
    
    public function items()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }
    
    static public function getTotalOrders()
    {
        $data = self::select('id')->where('is_payment', '=', 1)->where('deleted', '=', 0)->count();

        return $data;
    }
    
    static public function getTotalOrdersToday()
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();

        return $data;
    }

    static public function TotalOrderMonth($start_date, $end_date)
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->count();

        return $data;
    }
    
    static public function getTotalOrderAmountMonth($start_date, $end_date)
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->sum('total_amount');

        return $data;
    }

    
    static public function getTotalPayment()
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->sum('total_amount');

        return $data;
    }
    
    static public function getTotalAmount()
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->sum('total_amount');

        return $data;
    }
    static public function getTotalAmountToday()
    {
        $data = self::select('id')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->sum('total_amount');

        return $data;
    }

    static public function getLatestOrders() 
    {
        $data = self::select('orders.*')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();

        return $data;
    }
    
    static public function getTotalOrderMonth() 
    {
        $data = self::select('orders.*')
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();

        return $data;
    }

    // USER

    static public function getTotalOrdersUser($user_id)
    {
        $data = self::select('id')
                ->where('user_id', '=', $user_id)
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->count();

        return $data;
    }
    
    static public function getTotalOrdersTodayUser($user_id)
    {
        $data = self::select('id')
                ->where('user_id', '=', $user_id)
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();

        return $data;
    }

    static public function getTotalAmountUser($user_id)
    {
        $data = self::select('id')
                ->where('user_id', '=', $user_id)
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->sum('total_amount');

        return $data;
    }
    static public function getTotalAmountTodayUser($user_id)
    {
        $data = self::select('id')
                ->where('user_id', '=', $user_id)
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->sum('total_amount');

        return $data;
    }

    static public function getTotalStatusUser($user_id, $status)
    {
        $data = self::select('id')
                ->where('status', '=', $status)
                ->where('user_id', '=', $user_id)
                ->where('is_payment', '=', 1)
                ->where('deleted', '=', 0)
                ->count();

        return $data;
    }

    static public function getOrdersUser($user_id) {
        $data = self::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('deleted', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $data;
    }
    
    static public function getOrderUser($user_id, $id) {
        $data = self::select('orders.*')
            ->where('id', '=', $id)
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('deleted', '=', 0)
            ->first();

        return $data;
    }
}
