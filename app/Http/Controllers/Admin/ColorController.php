<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Auth;

class ColorController extends Controller
{
    public function index()
    {
        $data['getColors'] = Color::getColors();
        $data['header_title'] = "Color";
        
        return view('admin.color.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Color";
        
        return view('admin.color.create', $data);
    }

    public function store(Request $request)
    {
        $color = new Color;
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color')->with('success', "Color Successfully Created");
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
        $data['getColor'] = Color::getColor($id);
        $data['header_title'] = "Edit Color";
        
        return view('admin.color.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $color = Color::getColor($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color')->with('success', "Color Successfully Updated");
    }

    public function destroy(string $id)
    {
        $color = Color::getColor($id);    
        $color->deleted = 0;
        $color->save();

        return redirect()->back()->with('success', "Color Successfully Deleted");
    }
}
