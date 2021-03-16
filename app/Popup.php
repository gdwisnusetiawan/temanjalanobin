<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'popup';
    public $timestamps = false;
    protected $connection = 'web';

    public function getImageUrlAttribute()
    {
        $cdn = env('APP_STORAGE_URL').'foto/';
        $classname = strtolower(class_basename($this));
        $url = $cdn.$classname.'/'.$this->id.'/';
        if(Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        else {
            // return is_file(public_path().'/img/'.$this->image) 
            //     ? asset('img/'.$this->image) 
            //     : asset('polo-5/images/shop-bg.jpg');
            return $url.'image';
        }
    }

    public function getLinksAttribute()
    {
        if($this->link) {
            if(Str::startsWith($this->link, 'http')) {
                return $this->link;
            }
            else {
                return route('page.index', $this->link);
            }
        }
        else {
            return '#';
        }
    }
}
