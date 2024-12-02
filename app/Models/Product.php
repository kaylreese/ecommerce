<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    static public function getProducts()
    {
        return self::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('users', 'users.id', '=', 'subcategories.created_by')
                ->where('products.status', '=', 1)
                ->orderBy('products.id', 'desc')
                ->paginate(10);
    }

    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $data = Product::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.url as category_url', 'subcategories.name as subcategory_name', 'subcategories.url as subcategory_url')
                ->join('users', 'users.id', '=', 'products.created_by')
                ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                ->join('categories', 'categories.id', '=', 'products.category_id');

                if(!empty($category_id)) {
                    $data = $data->where('products.category_id', '=', $category_id);
                }

                if(!empty($subcategory_id)) {
                    $data = $data->where('products.subcategory_id', '=', $subcategory_id);
                }

                $data = $data->where('products.status', '=', 1)
                ->orderBy('products.id', 'desc')
                ->paginate(5);

        return $data;
    }

    static public function getImageSingle($id) 
    {
        return ProductImage::where('product_id', '=', $id)->orderBy('order_by', 'asc')->first();
    }

    static public function checkUrl($url)
    {
        return self::where('url', '=', $url)->count();
    }

    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function getSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc');
    }
}
