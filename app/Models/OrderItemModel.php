<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderItemModel extends Model
{
    use HasFactory;

    protected $table = 'orders_items';
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    static public function getReview($product_id, $order_id) 
    {
        return ProductReviewModel::getReview($product_id, $order_id, Auth::user()->id);
    }
}
