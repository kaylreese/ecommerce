<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;

class OrderController extends Controller
{
    public function index()
    {
        $data['getOrders'] = OrderModel::getOrders();
        $data['header_title'] = "Orders";
        
        return view('admin.orders.index', $data);
    }

    public function show(string $id)
    {
        $data['order'] = OrderModel::getOrder($id);
        $data['header_title'] = "Order Detail";
        
        return view('admin.orders.detail', $data);
    }

    // public function edit(string $id)
    // {
    //     $product = OrderModel::find($id);

    //     if(!empty($product)) {
    //         $data['getCategories'] = Category::getCategories();
    //         $data['getBrands'] = Brand::getBrandsActive();
    //         $data['getColors'] = Color::getColorsActive();
    //         $data['product'] = $product;
    //         $data['getsubcategory'] = SubCategory::getCategory($product->category_id);
    //         $data['header_title'] = "Edit Order";
        
    //         return view('admin.orders.edit', $data);
    //     } else {

    //     } 
    // }

    // public function update(Request $request, string $id)
    // {
    //     $title = trim($request->title);
    //     $url = Str::slug($title, '-');

    //     $product = OrderModel::find($id);

    //     if(!empty($product)) {
    //         $product->title = $title;
    //         $product->url = $url;
    //         $product->category_id = $request->category_id;
    //         $product->subcategory_id = $request->subcategory_id;
    //         $product->brand_id = trim($request->brand_id);
    //         $product->old_price = trim($request->old_price);
    //         $product->price = trim($request->price);
    //         $product->short_description = trim($request->short_description);
    //         $product->description = trim($request->description);
    //         $product->additional_information = trim($request->additional_information);
    //         $product->shipping_returns = trim($request->shipping_returns);
    //         $product->status = trim($request->status);
    //         $product->save();

    //         ProductColor::DeleteProductColor($product->id);

    //         if(!empty($request->color_id)) {
    //             foreach ($request->color_id as $value) {
    //                 $color = new ProductColor;
    //                 $color->color_id = $value;
    //                 $color->product_id = $product->id;
    //                 $color->save();
    //             }
    //         }

    //         ProductSize::DeleteProductSize($product->id);

    //         if(!empty($request->size)) {
    //             foreach ($request->size as $value) {
    //                 if(!empty($value['name'])) {
    //                     $size = new ProductSize;
    //                     $size->product_id = $product->id;
    //                     $size->name = $value['name'];
    //                     $size->price = !empty($value['price']) ? $value['price'] : 0.00;
    //                     $size->save();
    //                 }
    //             }
    //         }

    //         if(!empty($request->file('image'))) {
    //             foreach ($request->file('image') as $value) {
    //                 if($value->isValid()) {
    //                     $ext = $value->getClientOriginalExtension();
    //                     $randomStr = $product->id.Str::random(10);
    //                     $filename = strtolower($randomStr).'.'.$ext;
    //                     $value->move('upload/orderss/', $filename);

    //                     $image = new ProductImage;
    //                     $image->product_id = $product->id;
    //                     $image->name = $filename;
    //                     $image->extension = $ext;
    //                     $image->save();
    //                 }
    //             }
    //         }

    //         // return redirect('admin/orders')->with('success', "Order Successfully Updated");
    //         return redirect()->back()->with('success', "Order Successfully Updated");
    //     } else {
    //         abort(404);
    //     }

    //     // dd($request->all());
    // }

    // public function image_delete($id) 
    // {
    //     $image = ProductImage::getProductImage($id);    

    //     if(!empty($image->getLogo())) {
    //         unlink('upload/orderss/'.$image->name);
    //     }
    //     $image->delete();

    //     return redirect()->back()->with('success', "Order Image Successfully Deleted");
    // }

    // public function product_image_sortable(Request $request) 
    // {
    //     if(!empty($request->photo_id)) {
    //         $i = 1;
    //         foreach($request->photo_id as $value) {
    //             $image = ProductImage::getProductImage($value);
    //             $image->order_by = $i;
    //             $image->save();

    //             $i++;
    //         }
    //     }

    //     $json['success'] = true;
    //     echo json_encode($json);
    // }

    public function destroy(string $id)
    {
        $product = OrderModel::find($id);    
        $product->status = 0;
        $product->save();

        return redirect()->back()->with('success', "Order Successfully Deleted");
    } 
}
