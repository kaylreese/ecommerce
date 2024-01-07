<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function getCategory($url, $suburl = '')
    {
        // $category = Category::where('url', '=', $url)->first();
        $getCategory = Category::getCategoryUrl($url);
        $getSubCategory = SubCategory::getSubCategoryUrl($suburl);

        if(!empty($getCategory) && !empty($getSubCategory)) {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            $data['meta_description'] = $getSubCategory->meta_description;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            return view('product.index')->with($data);
        } else if(!empty($getCategory)) {
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['meta_description'] = $getCategory->meta_description;

            $data['getCategory'] = $getCategory;

            return view('product.index')->with($data);
        } else {
            abort(404);
        }
    }
}
