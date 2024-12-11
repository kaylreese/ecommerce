<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $data['comments'] = CommentModel::getComments();
        $data['header_title'] = "Comments";
        
        return view('admin.comments.index', $data);
    }
}
