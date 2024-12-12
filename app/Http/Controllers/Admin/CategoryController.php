<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->created_by = Auth::user()->id;

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $category->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/category/', $filename);
        
            $category->image_name = $filename;
        }

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
        $category = Category::getCategory($id);

        request()->validate([
            'url' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);
        
        
        $category->name = trim($request->name);
        $category->url = trim($request->url);
        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_description = trim($request->meta_description);
        $category->created_by = Auth::user()->id;

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $category->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/category/', $filename);
        
            $category->image_name = $filename;
        }

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
