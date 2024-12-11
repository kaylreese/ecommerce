<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSettingModel extends Model
{
    use HasFactory;

    protected $table = 'home_setting';

    static public function getSettings()
    {
        return self::find(1);
    }
    
    public function getPaymentDeliveryImage()
    {
        if(!empty($this->payment_delivery_image) && file_exists('public/upload/homesetting/'.$this->payment_delivery_image)) {
            return url('public/upload/homesetting/'.$this->payment_delivery_image);
        } else {
            return '';
        }
    }
    public function getRefundImage()
    {
        if(!empty($this->refund_image) && file_exists('public/upload/homesetting/'.$this->refund_image)) {
            return url('public/upload/homesetting/'.$this->refund_image);
        } else {
            return '';
        }
    }
    
    public function getSupportImage()
    {
        if(!empty($this->support_image) && file_exists('public/upload/homesetting/'.$this->support_image)) {
            return url('public/upload/homesetting/'.$this->support_image);
        } else {
            return '';
        }
    }
    
    public function getSingupImage()
    {
        if(!empty($this->singup_image) && file_exists('public/upload/homesetting/'.$this->singup_image)) {
            return url('public/upload/homesetting/'.$this->singup_image);
        } else {
            return '';
        }
    }
}
