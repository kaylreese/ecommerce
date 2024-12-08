<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewModel extends Model
{
    use HasFactory;
    
    protected $table = 'product_review'; 

    static public function getProductReview($id)
    {
        return self::find($id);
    }

    static public function getReview($product_id, $order_id, $user_id) 
    {
        return self::select('*')
                ->where('product_id', '=', $product_id)
                ->where('order_id', '=', $order_id)
                ->where('user_id', '=', $user_id)
                ->first();
    }
}
