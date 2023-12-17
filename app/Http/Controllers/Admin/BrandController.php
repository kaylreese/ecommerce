<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;

class BrandController extends Controller
{
    public function index()
    {
        $data['getBrands'] = Brand::getBrands();
        $data['header_title'] = "Brand";
        
        return view('admin.brand.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Brand";
        
        return view('admin.brand.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required|unique:brands'
        ]);

        $brand = new Brand;
        $brand->name = trim($request->name);
        $brand->url = trim($request->url);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->meta_description = trim($request->meta_description);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand')->with('success', "Brand Successfully Created");
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
        $data['getBrand'] = Brand::getBrand($id);
        $data['header_title'] = "Edit Brand";
        
        return view('admin.brand.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        request()->validate([
            'url' => 'required|unique:brands'
        ]);
        
        $brand = Brand::getBrand($id);
        $brand->name = trim($request->name);
        $brand->url = trim($request->url);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->meta_description = trim($request->meta_description);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand')->with('success', "Brand Successfully Updated");
    }

    public function destroy(string $id)
    {
        $brand = Brand::getBrand($id);    
        $brand->deleted = 0;
        $brand->save();

        return redirect()->back()->with('success', "Brand Successfully Deleted");
    }
}
