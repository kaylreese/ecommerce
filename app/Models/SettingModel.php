<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;

    protected $table = 'settings';

    static public function getSettings()
    {
        return self::find(1);
    }
    
    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('public/upload/setting/'.$this->logo)) {
            return url('public/upload/setting/'.$this->logo);
        } else {
            return '';
        }
    }
    public function getFavicon()
    {
        if(!empty($this->favicon) && file_exists('public/upload/setting/'.$this->favicon)) {
            return url('public/upload/setting/'.$this->favicon);
        } else {
            return '';
        }
    }
    
    public function getfooterLogo()
    {
        if(!empty($this->footer_logo) && file_exists('public/upload/setting/'.$this->footer_logo)) {
            return url('public/upload/setting/'.$this->footer_logo);
        } else {
            return '';
        }
    }
    
    public function getfooterPayment()
    {
        if(!empty($this->footer_payment_icon) && file_exists('public/upload/setting/'.$this->footer_payment_icon)) {
            return url('public/upload/setting/'.$this->footer_payment_icon);
        } else {
            return '';
        }
    }
}
