<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images'; 

    static public function getProductImage($id)
    {
        return self::find($id);
    }

    public function getLogo()
    {
        if(!empty($this->name) && file_exists('public/upload/products/'.$this->name)) {
            return url('public/upload/products/'.$this->name);
        } else {
            return "";
        }
    }

    static public function DeleteProductImage($product_id)
    {
        self::where('product_id', '=', $product_id)->delete();
    }
}
