<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                ->orderBy('categories.id', 'desc')
                ->get();
    }
}
