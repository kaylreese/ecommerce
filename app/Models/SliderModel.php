<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    use HasFactory;

    protected $table = 'slider';

    static public function getSliders()
    {
        return self::select('*')
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

    static public function getSlider($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/slider/'.$this->image_name)) {
            return url('public/upload/slider/'.$this->image_name);
        } else {
            return "";
        }
    }

    static public function getSlidersActive()
    {
        return self::select('*')
                ->where('state', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
    }
}
