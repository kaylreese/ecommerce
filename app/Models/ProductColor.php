<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';

    static public function getProductColor($id)
    {
        return self::find($id);
    }

    static public function DeleteProductColor($product_id)
    {
        self::where('product_id', '=', $product_id)->delete();
    }
}
