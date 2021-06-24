<?php

namespace App;

use App\Helpers\Functions;
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
            // return is_file(public_path().'/img/'.$this->bgimage) 
            //     ? asset('img/'.$this->bgimage) 
            //     : '';
                // : asset('polo-5/images/slider/100.jpg');

            return env('APP_STORAGE_URL').'foto/slider/'.$this->id.'/bgimage';
        }
    }

    public function link($column)
    {
        if(Str::startsWith($column, 'http')) {
            return $column;
        }
        else {
            return route('page.index', $column);
        }
    }

    public function getSlidertxtAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getButton1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getSliderlink1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getButton2Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getSliderlink2Attribute($value)
    {
        return Functions::translate($value);
    }
}
