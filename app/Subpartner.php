<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Subpartner extends Model
{
    protected $table = 'partnersub';
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
            return $url.'image';
        }
    }
}
