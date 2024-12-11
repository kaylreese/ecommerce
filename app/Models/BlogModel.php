<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class BlogModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog';

    static public function getBlogs()
    {
        return self::select('blog.*', 'categories.name as category_name')
                ->join('categories', 'categories.id', '=', 'blog.blogcategory_id')
                ->where('blog.status', '=', 1)
                ->orderBy('blog.id', 'desc')
                ->paginate(10);
    }

    static public function getBlog($id)
    {
        return self::find($id);
    }

    static public function getUrl($suburl)
    {
        return self::where('url', '=', $suburl)
                    ->where('blog.status', '=', 1)
                    ->first();
    }

    public function category()
    {
        return $this->belongsTo(BlogCategoryModel::class, 'blogcategory_id');
    }
    
    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'blog_id')
                ->select('comments.*')
                ->join('users', 'users.id', '=', 'comments.user_id');
    }
    
    public function commentCount()
    {
        return $this->hasMany(CommentModel::class, 'blog_id')
                ->select('comments.*')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->count();
    }

    // static public function getCategory($category_id)
    // {
    //     return self::select('blog.*')
    //             ->where('blog.blogcategory_id', '=', $category_id)
    //             ->where('blog.status', '=', 1)
    //             ->orderBy('blog.id', 'asc')
    //             ->get();
    // }

    static public function getBlogsHome($category_id = '')
    {
        $data = self::select('blog.*', 'categories.name as category_name');

        if (!empty(Request::get('search'))) {
            $data = $data->where('blog.title', 'like', '%'.Request::get('search').'%');
        }
        
        if (!empty($category_id)) {
            $data = $data->where('blog.blogcategory_id', '=',  $category_id);
        }

        $data = $data->join('categories', 'categories.id', '=', 'blog.blogcategory_id')
                ->where('blog.status', '=', 1)
                ->orderBy('blog.id', 'desc')
                ->paginate(10);

        return $data;
    }

    static public function getBlogsHomeActive()
    {
        return self::select('blog.*', 'categories.name as category_name')
                ->join('categories', 'categories.id', '=', 'blog.blogcategory_id')
                ->where('blog.status', '=', 1)
                ->orderBy('blog.id', 'desc')
                ->limit(3)
                ->get();
    }
    
    static public function getPopular()
    {
        return self::select('blog.*')
                ->where('blog.status', '=', 1)
                ->orderBy('blog.total_view', 'desc')
                ->limit(6)
                ->get();
    }
    
    static public function getRelatedPost($blogcategory_id, $blog_id)
    {
        return self::select('blog.*')
                ->where('blog.blogcategory_id', '=', $blogcategory_id)
                ->where('blog.id', '!=', $blog_id)
                ->where('blog.status', '=', 1)
                ->orderBy('blog.total_view', 'desc')
                ->limit(6)
                ->get();
    }

    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/blog/'.$this->image_name)) {
            return url('public/upload/blog/'.$this->image_name);
        } else {
            return "";
        }
    }

    public function generarSlug($title)
    {
        $textoSinTildes = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ä', 'ë', 'ï', 'ö', 'ü', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü'],
            ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'],
            $title
        );

        $textoLimpio = str_replace(
            ['.', ',', '"', "'", '´', '`', '¨'],
            '',
            $textoSinTildes
        );

        $textoMinusculas = strtolower($textoLimpio);

        return Str::slug($textoMinusculas, '-');
    }
}
