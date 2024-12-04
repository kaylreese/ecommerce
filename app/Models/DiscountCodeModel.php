<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodeModel extends Model
{
    use HasFactory;

    protected $table = 'discount_code';

    static public function getDiscountCode($id)
    {
        return self::find($id);
    }

    static public function getDiscountCodes()
    {
        return self::select('*')
                ->where('deleted', '=', 0)
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate(20);
    }
    
    static public function CheckDiscount($discount_code)
    {
        return self::select('*')
                ->where('name', '=', $discount_code)
                ->where('expire_date', '>=', date('Y-m-d'))
                ->where('deleted', '=', 0)
                ->where('status', '=', 1)
                ->first();
    }
}
