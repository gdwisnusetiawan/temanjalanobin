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
        if(Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        else {
            return is_file(public_path().'/img/'.$this->image) 
                ? asset('img/'.$this->image) 
                : asset('polo-5/images/shop-bg.jpg');
        }
    }

    public function getLinksAttribute()
    {
        if(Str::startsWith($this->link, 'http')) {
            return $this->link;
        }
        else {
            return route('page.index', $this->link);
        }
    }
}
