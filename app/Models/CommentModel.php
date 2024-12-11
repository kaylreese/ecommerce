<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';

    static public function getComments()
    {
        return self::select('*')
                ->where('status', '=', 1)
                ->orderBy('id', 'desc')
                ->get();
    }

    static public function getComment($id)
    {
        return self::find($id);
    }

    public function getCountComment()
    {
        return $this->hasMany(BlogModel::class, 'blog_id')
                ->where('status', '=', 1)
                ->count();
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

