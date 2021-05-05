<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Subtestimonial extends Model
{
    protected $table = 'subtestimonial';
    public $timestamps = false;
    protected $connection = 'web';

    public function getImageUrlAttribute()
    {
        $cdn = env('APP_STORAGE_URL').'foto/';
        $classname = strtolower(class_basename($this));
        $url = $cdn.$classname.'/'.$this->id.'/';
        if(Str::startsWith($this->picture, 'http')) {
            return $this->picture;
        }
        else {
            return $url.'picture';
        }
    }
}
