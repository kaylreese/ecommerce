<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingChargeModel extends Model
{
    use HasFactory;

    protected $table = 'shipping_charge';

    static public function getShippingCharge($id)
    {
        return self::find($id);
    }

    static public function getShippingCharges()
    {
        return self::select('*')
                ->where('deleted', '=', 0)
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate(20);
    }
    
    static public function getShippingChargesActive()
    {
        return self::select('*')
                ->where('deleted', '=', 0)
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
                ->get();
    }
}
