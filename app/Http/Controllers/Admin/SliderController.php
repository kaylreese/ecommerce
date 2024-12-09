<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $data['sliders'] = SliderModel::getSliders();
        $data['header_title'] = "Sliders";
        
        return view('admin.slider.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Slider";
        
        return view('admin.slider.create', $data);
    }

    public function store(Request $request)
    {
        $slider = new SliderModel;
        $slider->title = trim($request->title);
        $slider->subtitle = trim($request->subtitle);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);
        $slider->state = trim($request->state);

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $slider->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/slider/', $filename);
        
            $slider->image_name = $filename;
        }

        $slider->save();

        return redirect('admin/slider')->with('success', "Slider Successfully Created");
    }

    public function edit(string $id)
    {
        $data['slider'] = SliderModel::getSlider($id);
        $data['header_title'] = "Edit Slider";
        
        return view('admin.slider.edit', $data);
    }

    public function update(Request $request, string $id)
    {   
        $slider = SliderModel::getSlider($id);

        $slider->title = trim($request->title);
        $slider->subtitle = trim($request->subtitle);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);
        $slider->state = trim($request->state);

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $slider->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/slider/', $filename);
        
            $slider->image_name = $filename;
        }

        $slider->save();

        return redirect('admin/slider')->with('success', "Slider Successfully Updated");
    }

    public function destroy(string $id)
    {
        $slider = SliderModel::getSlider($id);    
        $slider->delete();

        return redirect()->back()->with('success', "Slider Successfully Deleted");
    }
}
