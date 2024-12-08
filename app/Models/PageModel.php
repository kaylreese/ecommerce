<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;

    protected $table = 'page';

    static public function getPages()
    {
        return self::select('*')->get();
    }

    static public function getPage($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('upload/page/'.$this->image_name)) {
            return url('upload/page/'.$this->image_name);
        } else {
            return "";
        }
    }
}
