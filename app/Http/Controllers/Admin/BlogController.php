<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $data['blogs'] = BlogModel::getBlogs();
        $data['header_title'] = "Blogs";
        
        return view('admin.blog.index', $data);
    }

    public function create()
    {
        $data['getCategories'] = BlogCategoryModel::getCategories();
        $data['header_title'] = "New Blog";
        
        return view('admin.blog.create', $data);
    }

    public function store(Request $request)
    {
        $blog = new BlogModel;
        $blog->blogcategory_id = $request->blogcategory_id;
        $blog->title = trim($request->title);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_keywords = trim($request->meta_keywords);
        $blog->meta_description = trim($request->meta_description);

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $blog->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/blog/', $filename);
        
            $blog->image_name = $filename;
        }

        $slug = Str::slug($request->title);
        $count = BlogModel::where('url', '=', $slug)->count();

        if (!empty($count)) {
            $blog->url = $slug.'-'.$blog->id;
        } else {
            $blog->url = trim($slug);
        }
        
        $blog->save();

        return redirect('admin/blog')->with('success', "Blog Successfully Created");
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
        $data['blog'] = BlogModel::getBlog($id);
        $data['getCategories'] = BlogCategoryModel::getCategories();
        $data['header_title'] = "Edit Blog";
        
        return view('admin.blog.edit', $data);
    }

    public function update(Request $request, string $id)
    {        
        $blog = BlogModel::getBlog($id);
        $blog->blogcategory_id = trim($request->blogcategory_id);
        $blog->title = trim($request->title);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_keywords = trim($request->meta_keywords);
        $blog->meta_description = trim($request->meta_description);

        if (!empty($request->file('image_name'))) {
            if(!empty($blog->getImage())) {
                unlink('public/upload/blog/'.$blog->image_name);
            }

            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $blog->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/blog/', $filename);
        
            $blog->image_name = $filename;
        }

        $slug = Str::slug($request->title);
        $count = BlogModel::where('url', '=', $slug)->count();

        if (!empty($count)) {
            $blog->url = $slug.'-'.$blog->id;
        } else {
            $blog->url = trim($slug);
        }

        $blog->save();

        return redirect('admin/blog')->with('success', "Blog Successfully Updated");
    }

    public function destroy(string $id)
    {
        $blog = BlogModel::getBlog($id);    
        $blog->status = 0;
        unlink('public/upload/blog/'.$blog->image_name);
        $blog->save();
        $blog->delete();

        return redirect()->back()->with('success', "Blog Successfully Deleted");
    }

    public function getBlogModel(Request $request)
    {
        $category_id = $request->id;
        $getBlogModel = BlogModel::getCategory($category_id);
        $html = '';
        $html .= '<option value="">SELECT. . .</option>';
        foreach ($getBlogModel as $value) {
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        
        $json['html'] = $html;
        echo json_encode($json);
    }
}
