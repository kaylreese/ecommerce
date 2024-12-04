<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingChargeModel;

class ShippingChargeController extends Controller
{
    public function index()
    {
        $data['getShippingCharges'] = ShippingChargeModel::getShippingCharges();
        $data['header_title'] = "Shipping Charges";
        
        return view('admin.shippingcharge.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Color";
        
        return view('admin.shippingcharge.create', $data);
    }

    public function store(Request $request)
    {
        $discount = new ShippingChargeModel;
        $discount->name = trim($request->name);
        $discount->price = trim($request->price);
        $discount->status = trim($request->status);
        $discount->save();

        return redirect('admin/shippingcharge')->with('success', "Shipping Charge Successfully Created");
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['getShippingCharge'] = ShippingChargeModel::getShippingCharge($id);
        $data['header_title'] = "Edit Shipping Charge";
        
        return view('admin.shippingcharge.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $discount = ShippingChargeModel::getShippingCharge($id);
        $discount->name = trim($request->name);
        $discount->price = trim($request->price);
        $discount->status = trim($request->status);
        $discount->save();

        return redirect('admin/shippingcharge')->with('success', "Shipping Charge Successfully Updated");
    }

    public function destroy(string $id)
    {
        $discount = ShippingChargeModel::getShippingCharge($id);    
        $discount->deleted = 1;
        $discount->status = 0;
        $discount->save();

        return redirect()->back()->with('success', "Shipping Charge Successfully Deleted");
    }
}
