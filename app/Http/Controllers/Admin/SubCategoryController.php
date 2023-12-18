<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data['getSubCategories'] = SubCategory::getSubCategories();
        $data['header_title'] = "Sub Category";
        
        return view('admin.subcategory.index', $data);
    }

    public function create()
    {
        $data['getCategories'] = Category::getCategories();
        $data['header_title'] = "add New Sub Category";
        
        return view('admin.subcategory.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required|unique:categories'
        ]);

        $subcategory = new SubCategory;
        $subcategory->category_id = $request->category_id;
        $subcategory->name = trim($request->name);
        $subcategory->url = trim($request->url);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/subcategory')->with('success', "Sub Category Successfully Created");
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
        $data['getSubCategory'] = SubCategory::getSubCategory($id);
        $data['getCategories'] = Category::getCategories();
        $data['header_title'] = "Edit Sub Category";
        
        return view('admin.subcategory.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        request()->validate([
            'url' => 'required|unique:categories'
        ]);
        
        $subcategory = SubCategory::getSubCategory($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->url = trim($request->url);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/subcategory')->with('success', "Sub Category Successfully Updated");
    }

    public function destroy(string $id)
    {
        $subcategory = SubCategory::getSubCategory($id);    
        $subcategory->status = 0;
        $subcategory->save();

        return redirect()->back()->with('success', "Sub Category Successfully Deleted");
    }

    public function getsubcategory(Request $request)
    {
        $category_id = $request->id;
        $getsubcategory = SubCategory::getCategory($category_id);
        $html = '';
        $html .= '<option value="">Select. . .</option>';
        foreach ($getsubcategory as $value) {
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        
        $json['html'] = $html;
        echo json_encode($json);
    }
}
