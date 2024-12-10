<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategoryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $data['getCategories'] = BlogCategoryModel::getCategories();
        $data['header_title'] = "Blog Category";
        
        return view('admin.blogcategory.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add Blog Category";
        
        return view('admin.blogcategory.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required|unique:blog_category'
        ]);

        $category = new BlogCategoryModel;
        $category->name = trim($request->name);
        $category->title = trim($request->title);
        $category->url = trim($request->url);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->save();

        return redirect('admin/blogcategory')->with('success', "Blog Category Successfully Created");
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
        $data['getCategory'] = BlogCategoryModel::getCategory($id);
        $data['header_title'] = "Edit Blog Category";
        
        return view('admin.blogcategory.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $category = BlogCategoryModel::getCategory($id);

        request()->validate([
            'url' => [
                'required',
                Rule::unique('blog_category')->ignore($category->id),
            ],
        ]);
        
        
        $category = new BlogCategoryModel;
        $category->name = trim($request->name);
        // $category->title = trim($request->title);
        $category->url = trim($request->url);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->save();

        return redirect('admin/blogcategory')->with('success', "Blog Category Successfully Updated");
    }

    public function destroy(string $id)
    {
        $category = BlogCategoryModel::getCategory($id);    
        $category->status = 0;
        $category->save();
        $category->delete();

        return redirect()->back()->with('success', "Blog Category Successfully Deleted");
    }
}
