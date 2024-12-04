<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCodeModel;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function index()
    {
        $data['getDiscountCodes'] = DiscountCodeModel::getDiscountCodes();
        $data['header_title'] = "Discount Codes";
        
        return view('admin.discountcode.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Add New Color";
        
        return view('admin.discountcode.create', $data);
    }

    public function store(Request $request)
    {
        $discount = new DiscountCodeModel;
        $discount->name = trim($request->name);
        $discount->type = trim($request->type);
        $discount->percent_amount = trim($request->percent_amount);
        $discount->expire_date = trim($request->expire_date);
        $discount->status = trim($request->status);
        $discount->save();

        return redirect('admin/discountcode')->with('success', "Discount Code Successfully Created");
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
        $data['getDiscountCode'] = DiscountCodeModel::getDiscountCode($id);
        $data['header_title'] = "Edit Discount Code";
        
        return view('admin.discountcode.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $discount = DiscountCodeModel::getDiscountCode($id);
        $discount->name = trim($request->name);
        $discount->type = trim($request->type);
        $discount->percent_amount = trim($request->percent_amount);
        $discount->expire_date = trim($request->expire_date);
        $discount->status = trim($request->status);
        $discount->save();

        return redirect('admin/discountcode')->with('success', "Discount Code Successfully Updated");
    }

    public function destroy(string $id)
    {
        $discount = DiscountCodeModel::getDiscountCode($id);    
        $discount->deleted = 1;
        $discount->status = 0;
        $discount->save();

        return redirect()->back()->with('success', "Discount Code Successfully Deleted");
    }
}
