<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProductSearch(Request $request) 
    {
        $data['meta_title'] = 'Search';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        $getProduct = Product::getProduct();

        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct ->nextPageUrl());
            if (!empty($parse_url [ 'query']))
            {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        $data['page'] = $page;

        $data["getProduct"] = $getProduct;

        $data['getColor'] = Color::getColorsActive();
        $data['getBrand'] = Brand::getBrandsActive();

        return view('product.index', $data);
    }

    public function getCategory($url, $suburl = '')
    {
        $getProductSingle = Product::getSingleSlug($url);

        // $category = Category::where('url', '=', $url)->first();
        $getCategory = Category::getCategoryUrl($url);
        $getSubCategory = SubCategory::getSubCategoryUrl($suburl);

        $data['getColor'] = Color::getColorsActive();
        $data['getBrand'] = Brand::getBrandsActive();

        if(!empty($getProductSingle )) {
            $data['meta_title'] = $getProductSingle->title;
            $data['meta_description'] = $getProductSingle->short_description;

            $data["getProduct"] = $getProductSingle;

            $data['getRelatedProduct'] = Product::getRelatedProduct($getProductSingle->id, $getProductSingle->subcategory_id);

            return view('product.detail')->with($data);
        }else if(!empty($getCategory) && !empty($getSubCategory)) {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            $data['meta_description'] = $getSubCategory->meta_description;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $data['getSubCategoryFilter'] = SubCategory::getCategory($getCategory->id);

            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct ->nextPageUrl());
                if (!empty($parse_url [ 'query']))
                {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data["getProduct"] = $getProduct;

            return view('product.index')->with($data);
        } else if(!empty($getCategory)) {
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['meta_description'] = $getCategory->meta_description;

            $data['getSubCategoryFilter'] = SubCategory::getCategory($getCategory->id);

            $data['getCategory'] = $getCategory;

            $getProduct = Product::getProduct($getCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct ->nextPageUrl());
                if (!empty($parse_url [ 'query']))
                {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data["getProduct"] = $getProduct;

            return view('product.index')->with($data);
        } else {
            abort(404);
        }
    }

    function productsFilter(Request $request) 
    {
        $getProduct = Product::getProduct();

        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct ->nextPageUrl());
            if (!empty($parse_url [ 'query']))
            {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        
        return response()->json([
            'status' => true,
            'page' => $page,
            'success' => view('product.list', ['getProduct' => $getProduct])->render()
        ], 200);

    }

    function wishlist()
    {
        $data['meta_title'] = 'Wishlist';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getProduct'] = Product::getMyWishlist(Auth::user()->id);

        return view('product.wishlist', $data);
    }
}
