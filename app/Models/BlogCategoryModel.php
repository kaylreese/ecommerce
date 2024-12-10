<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoryModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_category';

    static public function getCategories()
    {
        return self::select('*')
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
                ->get();
    }

    static public function getCategory($id)
    {
        return self::find($id);
    }
}
