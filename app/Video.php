<?php

namespace App;

use App\Helpers\Functions;
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
            if(Str::startsWith($this->video, 'http')) {
                return $this->video;
            }
            $cdn = env('APP_STORAGE_URL').'foto/';
            $classname = strtolower(class_basename($this));
            if($classname == 'config') {
                $classname = 'general';
            }
            elseif(in_array($classname, ['page', 'multipage', 'multisubpage'])) {
                $classname = $classname.'s';
            }
            $url = $cdn.$classname.'/'.$this->id.'/';
            return $url.'video';
        }
        elseif($this->youtube != null) {
            if(Str::startsWith($this->youtube, 'http')) {
                return $this->youtube;
            }
            return 'https://www.youtube.com/watch?v='.$this->youtube;
            // return 'https://www.youtube.com/embed/'.$this->youtube.'?rel=0&amp;showinfo=0&amp;autoplay=1';
        }
        else {
            return 'https://www.youtube.com/watch?v=S7SLep244ss';
            // return 'https://www.youtube.com/embed/S7SLep244ss?rel=0&amp;showinfo=0&amp;autoplay=1';
        }
    }

    public function getThumbnailAttribute()
    {
        if($this->video != null) {
            return asset('polo-5/images/other/youtube.gif');
        }
        elseif($this->youtube != null) {
            $id_position = strpos($this->youtube, 'v=');
            $youtube_id = substr($this->youtube, $id_position + 2);
            return 'https://img.youtube.com/vi/'.$youtube_id.'/0.jpg';
        }
        else {
            return 'https://img.youtube.com/vi/S7SLep244ss/0.jpg';
        }
    }

    public function getMimeTypeAttribute()
    {
        if($this->video != null) {
            return mime_content_type($this->video);
        }
        else {
            return 'youtube';
        }
    }

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }
}
