<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $data['pages'] = PageModel::getPages();
        $data['header_title'] = "Pages";
        
        return view('admin.page.index', $data);
    }

    public function edit(string $id)
    {
        $data['page'] = PageModel::getPage($id);
        $data['header_title'] = "Edit Page";
        
        return view('admin.page.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $page = PageModel::getPage($id);
        $page->name = trim($request->name);
        $page->url = trim($request->url);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_keywords = trim($request->meta_keywords);
        $page->meta_description = trim($request->meta_description);
        $page->state = trim($request->state);
        $page->save();

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('upload/page/', $filename);
        
            $page->image_name = $filename;
            $page->save();
        }

        

        return redirect('admin/page')->with('success', "Page Successfully Updated");
    }
}
