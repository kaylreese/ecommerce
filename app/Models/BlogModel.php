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

    static public function getCategory($category_id)
    {
        return self::select('blog.*')
                ->where('blog.blogcategory_id', '=', $category_id)
                ->where('blog.status', '=', 1)
                ->orderBy('blog.id', 'asc')
                ->get();
    }

    static public function getBlogsHome()
    {
        $data = self::select('blog.*', 'categories.name as category_name');

        if (!empty(Request::get('search'))) {
            $data = $data->where('blog.title', 'like', '%'.Request::get('search').'%');
        }

        $data = $data->join('categories', 'categories.id', '=', 'blog.blogcategory_id')
                ->where('blog.status', '=', 1)
                ->orderBy('blog.id', 'desc')
                ->paginate(10);

        return $data;
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
