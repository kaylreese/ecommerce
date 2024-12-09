<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['meta_title'] = 'Contact Us';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        $data['contactus'] = ContactModel::getContacts();

        return view('admin.contactus.index', $data);
    }

    public function destroy(string $id)
    {
        $color = ContactModel::getContact($id);    
        $color->delete();

        return redirect()->back()->with('success', "Contact Us Successfully Deleted");
    }
}
