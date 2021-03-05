<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    public $timestamps = false;
    protected $connection = 'web';

    public function getVideoUrlAttribute()
    {
        if($this->video != null) {
            $cdn = env('APP_STORAGE_URL').'foto/';
            $classname = strtolower(class_basename($model));
            if($classname == 'config') {
                $classname = 'general';
            }
            elseif(in_array($classname, ['page', 'multipage', 'multisubpage'])) {
                $classname = $classname.'s';
            }
            $url = $cdn.$classname.'/'.$model->id.'/';
            return $url.'video';
        }
        elseif($this->youtube != null) {
            if(Str::startsWith($this->youtube, 'http')) {
                return $this->youtube;
            }
            // return 'https://www.youtube.com/watch?v='.$this->youtube;
            return 'https://www.youtube.com/embed/'.$this->youtube.'?rel=0&amp;showinfo=0';
        }
        else {
            return 'https://www.youtube.com/embed/S7SLep244ss?rel=0&amp;showinfo=0';
        }
    }
}
