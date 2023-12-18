<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    static public function getSubCategories()
    {
        return self::select('subcategories.*', 'users.name as created_by_name', 'categories.name as category_name')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'subcategories.created_by')
                ->where('subcategories.status', '=', 1)
                ->orderBy('subcategories.id', 'desc')
                ->paginate(10);
    }

    static public function getSubCategory($id)
    {
        return self::find($id);
    }

    static public function getCategory($category_id)
    {
        return self::select('subcategories.*')
                ->join('users', 'users.id', '=', 'subcategories.created_by')
                ->where('subcategories.category_id', '=', $category_id)
                ->where('subcategories.status', '=', 1)
                ->orderBy('subcategories.id', 'asc')
                ->get();
    }
}
