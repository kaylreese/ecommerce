<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

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

                if(!empty(Request::get('subcategory_id'))) {
                    $subcategory_id = rtrim(Request::get('subcategory_id'), ',');

                    $subcategory_id_array = explode(",", $subcategory_id);

                    $data = $data->whereIn('products.subcategory_id', $subcategory_id_array);
                } else {
                    if(!empty(Request::get('old_category_id'))) {
                        $data = $data->where('products.category_id', '=', Request::get('old_category_id'));
                    }
    
                    if(!empty(Request::get('old_subcategory_id'))) {
                        $data = $data->where('products.subcategory_id', '=', Request::get('old_subcategory_id'));
                    }
                }
                
                if(!empty(Request::get('color_id'))) {
                    $color_id = rtrim(Request::get('color_id'), ',');

                    $color_id_array = explode(",", $color_id);

                    $data = $data->join('product_color', 'product_color.product_id', '=', 'products.id');
                    $data = $data->whereIn('product_color.color_id', $color_id_array);
                }

                if(!empty(Request::get('brand_id'))) {
                    $brand_id = rtrim(Request::get('brand_id'), ',');

                    $brand_id_array = explode(",", $brand_id);

                    $data = $data->whereIn('products.brand_id', $brand_id_array);
                }

                if(!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {
                    $start_price = str_replace('$', '', Request::get('start_price'));
                    $end_price = str_replace('$', '', Request::get('end_price'));

                    $data = $data->where('products.price', '>=', $start_price);
                    $data = $data->where('products.price', '<=', $end_price);
                }

                $data = $data->where('products.status', '=', 1)
                ->groupBy('products.id')
                ->orderBy('products.id', 'desc')
                ->paginate(3);

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
