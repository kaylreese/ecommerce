<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getOrder($id) {
        return self::find($id);
    }

    static public function getOrders() {
        $data = self::select('orders.*')->where('is_payment', '=', 1)->where('deleted', '=', 0)->orderBy('id', 'desc')->paginate(10);

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
