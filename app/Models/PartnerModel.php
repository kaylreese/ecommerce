<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    use HasFactory;

    protected $table = 'partner';

    static public function getPartners()
    {
        return self::select('*')
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

    static public function getPartner($id)
    {
        return self::find($id);
    }

    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/partner/'.$this->image_name)) {
            return url('public/upload/partner/'.$this->image_name);
        } else {
            return "";
        }
    }

    static public function getPartnersActive()
    {
        return self::select('*')
                ->where('state', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
    }
}
