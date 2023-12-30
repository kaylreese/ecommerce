<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Auth;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $data['getProducts'] = Product::getProducts();
        $data['header_title'] = "Product";
        
        return view('admin.product.index', $data);
    }

    public function create()
    {
        $data['getCategories'] = Category::getCategories();
        $data['header_title'] = "Add New Product";
        
        return view('admin.product.create', $data);
    }

    public function store(Request $request)
    {
        $title = trim($request->title);
        
        $product = new Product;
        $product->title = $title;
        // $product->category_id = $request->category_id;
        // $product->subcategory_id = $request->subcategory_id;
        // $product->size = trim($request->size);
        // $product->color = trim($request->color);
        // $product->brand_id = trim($request->brand_id);
        // $product->old_price = trim($request->old_price);
        // $product->price = trim($request->price);
        // $product->short_description = trim($request->short_description);
        // $product->description = trim($request->description);
        // $product->additional_information = trim($request->additional_information);
        // $product->shipping_returns = trim($request->shipping_returns);
        $product->created_by = Auth::user()->id;
        $product->save();

        $url = Str::slug($title, '-');

        $checkUrl = Product::checkUrl($url);
        if (empty($checkUrl)) {
            $product->url = $url;
            $product->save();
        } else {
            $new_url = $url.'-'.$product->id;
            $product->url = $new_url;
            $product->save();
        }

        return redirect('admin/product/edit/'.$product->id)->with('success', "Product Successfully Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Product::getProduct($id);

        if(!empty($product)) {
            $data['getCategories'] = Category::getCategories();
            $data['getBrands'] = Brand::getBrandsActive();
            $data['getColors'] = Color::getColorsActive();
            $data['product'] = $product;
            $data['getsubcategory'] = SubCategory::getCategory($product->category_id);
            $data['header_title'] = "Edit Product";
        
            return view('admin.product.edit', $data);
        } else {

        } 
    }

    public function update(Request $request, string $id)
    {
        
        // request()->validate([
        //     'url' => 'required|unique:products'
        // ]);
        
        $title = trim($request->title);
        $url = Str::slug($title, '-');

        $product = Product::getProduct($id);
        if(!empty($product)) {
            $product->title = $title;
            $product->url = $url;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            // $product->size = trim($request->size);
            // $product->color = trim($request->color);
            $product->brand_id = trim($request->brand_id);
            $product->old_price = trim($request->old_price);
            $product->price = trim($request->price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->status = trim($request->status);
            $product->save();

            ProductColor::DeleteProductColor($product->id);

            if(!empty($request->color_id)) {
                foreach ($request->color_id as $value) {
                    $color = new ProductColor;
                    $color->color_id = $value;
                    $color->product_id = $product->id;
                    $color->save();
                }
            }

            // return redirect('admin/product')->with('success', "Product Successfully Updated");
            return redirect()->back()->with('success', "Product Successfully Updated");
        } else {
            abort(404);
        }

        dd($request->all());
    }

    public function destroy(string $id)
    {
        $product = Product::getProduct($id);    
        $product->status = 0;
        $product->save();

        return redirect()->back()->with('success', "Product Successfully Deleted");
    } 
}
