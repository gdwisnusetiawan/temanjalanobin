<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'merchant';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    public function getLogoUrlAttribute()
    {
        $img_folder = '/img/logo/';
        if(Str::startsWith($this->logo, 'http') || $this->logo == null) {
            $img = $this->logo;
        }
        elseif(is_file(public_path().($img_folder.$this->logo))) {
            $img = asset($img_folder.$this->logo);
        }
        return $img;
    }
}
