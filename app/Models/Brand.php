<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    static public function getBrands()
    {
        return self::select('brands.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'brands.created_by')
                ->where('brands.deleted', '=', 1)
                ->orderBy('brands.id', 'desc')
                ->paginate(10);
    }

    static public function getBrand($id)
    {
        return self::find($id);
    }

    static public function checkUrl($url)
    {
        return self::where('url', '=', $url)->count();
    }
}
