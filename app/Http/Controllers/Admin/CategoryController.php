<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data['getCategories'] = Category::getCategories();
        $data['header_title'] = "Category";
        
        return view('admin.category.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "add New Category";
        
        return view('admin.category.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required|unique:categories'
        ]);

        $category = new Category;
        $category->name = trim($request->name);
        $category->url = trim($request->url);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category')->with('success', "Category Successfully Created");
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
        $data['getCategory'] = Category::getCategory($id);
        $data['header_title'] = "Edit Category";
        
        return view('admin.category.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        request()->validate([
            'url' => 'required|unique:categories'
        ]);
        
        $category = Category::getCategory($id);
        $category->name = trim($request->name);
        $category->url = trim($request->url);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category')->with('success', "Category Successfully Updated");
    }

    public function destroy(string $id)
    {
        $category = Category::getCategory($id);    
        $category->status = 0;
        $category->save();

        return redirect()->back()->with('success', "Category Successfully Deleted");
    }
}
