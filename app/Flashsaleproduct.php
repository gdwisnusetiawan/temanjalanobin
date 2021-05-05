<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Flashsaleproduct extends Model
{
    protected $table = 'flashsalesproducts';
    public $timestamps = false;
    protected $connection = 'web';

    public function getImageUrlAttribute()
    {
        $cdn = env('APP_STORAGE_URL').'foto/';
        $classname = 'flashsalesproducts';
        $url = $cdn.$classname.'/'.$this->id.'/';
        if(Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        else {
            return $url.'image';
        }
    }
}
