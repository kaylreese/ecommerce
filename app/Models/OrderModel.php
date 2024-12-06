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
}
