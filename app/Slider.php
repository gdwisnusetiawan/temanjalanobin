<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    protected $connection = 'web';

    public function getImageAttribute()
    {
        if(Str::startsWith($this->bgimage, 'http')) {
            return $this->bgimage;
        }
        else {
            return is_file(public_path().'/img/'.$this->bgimage) 
                ? asset('img/'.$this->bgimage) 
                : '';
                // : asset('polo-5/images/slider/100.jpg');
        }
    }
}
