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
    
    static public function getReviewProduct($product_id) 
    {
        return self::select('product_review.*', 'users.name', 'users.last_name')
                ->join('users', 'users.id', 'product_review.user_id')
                ->where('product_review.product_id', '=', $product_id)
                ->orderBy('product_review.product_id', 'desc')
                ->paginate(20);
    }

    public function getPercent()
    {
        $rating = $this->rating;

        if ($rating < 0) {
            $rating = 0;
        } elseif ($rating > 5) {
            $rating = 5;
        }

        $percent = ($rating / 5) * 100;

        return round($percent);
    }

    static public function getRatingAVG($product_id)
    {
        return self::select('product_review.rating')
                ->join('users', 'users.id', 'product_review.user_id')
                ->where('product_review.product_id', '=', $product_id)
                ->avg('product_review.rating');
    }
}
