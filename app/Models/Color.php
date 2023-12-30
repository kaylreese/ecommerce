<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    static public function getColors()
    {
        return self::select('colors.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'colors.created_by')
                ->where('colors.deleted', '=', 1)
                ->orderBy('colors.id', 'desc')
                ->paginate(10);
    }

    static public function getColor($id)
    {
        return self::find($id);
    }

    static public function getColorsActive()
    {
        return self::select('colors.*')
                ->join('users', 'users.id', '=', 'colors.created_by')
                ->where('colors.deleted', '=', 1)
                ->where('colors.status', '=', 1)
                ->orderBy('colors.name', 'asc')
                ->get();
    }
}
