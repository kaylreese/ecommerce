<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;

class ProductController extends Controller
{
    public function getCategory($url, $suburl = '')
    {
        // $category = Category::where('url', '=', $url)->first();
        $getCategory = Category::getCategoryUrl($url);
        $getSubCategory = SubCategory::getSubCategoryUrl($suburl);

        $data['getColor'] = Color::getColorsActive();
        $data['getBrand'] = Brand::getBrandsActive();

        if(!empty($getCategory) && !empty($getSubCategory)) {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            $data['meta_description'] = $getSubCategory->meta_description;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $data['getSubCategoryFilter'] = SubCategory::getCategory($getCategory->id);

            $data["getProduct"] = Product::getProduct($getCategory->id, $getSubCategory->id);

            return view('product.index')->with($data);
        } else if(!empty($getCategory)) {
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['meta_description'] = $getCategory->meta_description;

            $data['getSubCategoryFilter'] = SubCategory::getCategory($getCategory->id);

            $data['getCategory'] = $getCategory;
            $data["getProduct"] = Product::getProduct($getCategory->id);

            return view('product.index')->with($data);
        } else {
            abort(404);
        }
    }

    function productsFilter(Request $request) 
    {
        $getProduct = Product::getProduct();
        
        return response()->json([
            'status' => true,
            'success' => view('product.list', ['getProduct' => $getProduct])->render()
        ], 200);

    }
}
