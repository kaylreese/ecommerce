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

    public function getCountBlog()
    {
        return $this->hasMany(BlogModel::class, 'blogcategory_id')
                ->where('status', '=', 1)
                ->count();
    }
   
    public function getBlogs()
    {
        return $this->hasMany(BlogModel::class, 'blogcategory_id')
                ->where('status', '=', 1)
                ->count();
    }

    static public function getUrl($url)
    {
        return self::where('url', '=', $url)
                    ->where('status', '=', 1)
                    ->first();
    }
}
