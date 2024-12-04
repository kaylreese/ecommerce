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
}
