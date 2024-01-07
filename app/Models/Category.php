<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // protected $fillable = [
    //     'name',
    //     'url',
    //     'meta_title',
    //     'meta_keywords',
    //     'meta_description',
    //     'created_by',
    //     'status',
    // ];

    static public function getCategories()
    {
        return self::select('categories.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'categories.created_by')
                ->where('categories.status', '=', 1)
                ->orderBy('categories.id', 'desc')
                ->get();
    }

    static public function getCategory($id)
    {
        return self::find($id);
    }

    static public function getCategoryUrl($url)
    {
        return self::where('url', '=', $url)
                    ->where('categories.status', '=', 1)
                    ->first();
    }

    static public function getCategoriesMenu()
    {
        return self::select('categories.*')
                ->join('users', 'users.id', '=', 'categories.created_by')
                ->where('categories.status', '=', 1)
                ->orderBy('categories.id', 'asc')
                ->get();
    }

    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')->where('subcategories.status', '=', '1');
    }

}
