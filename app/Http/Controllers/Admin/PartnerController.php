<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PartnerModel;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $data['partners'] = PartnerModel::getPartners();
        $data['header_title'] = "Partners";
        
        return view('admin.partner.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Partner";
        
        return view('admin.partner.create', $data);
    }

    public function store(Request $request)
    {
        $partner = new PartnerModel;
        $partner->button_link = trim($request->button_link);
        $partner->state = trim($request->state);

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $partner->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/partner/', $filename);
        
            $partner->image_name = $filename;
        }

        $partner->save();

        return redirect('admin/partner')->with('success', "Partner Successfully Created");
    }

    public function edit(string $id)
    {
        $data['partner'] = PartnerModel::getPartner($id);
        $data['header_title'] = "Edit Slider";
        
        return view('admin.partner.edit', $data);
    }

    public function update(Request $request, string $id)
    {   
        $partner = PartnerModel::getPartner($id);

        $partner->button_link = trim($request->button_link);
        $partner->state = trim($request->state);

        if (!empty($request->file('image_name'))) {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $partner->id . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
        
            $file->move('public/upload/partner/', $filename);
        
            $partner->image_name = $filename;
        }

        $partner->save();

        return redirect('admin/partner')->with('success', "Partner Successfully Updated");
    }

    public function destroy(string $id)
    {
        $partner = PartnerModel::getPartner($id);    
        $partner->delete();

        return redirect()->back()->with('success', "Partner Successfully Deleted");
    }
}
