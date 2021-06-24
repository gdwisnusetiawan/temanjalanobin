<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partner';
    public $timestamps = false;
    protected $connection = 'web';

    public function getImageUrlAttribute()
    {
        $cdn = env('APP_STORAGE_URL').'foto/';
        $classname = strtolower(class_basename($this));
        $url = $cdn.$classname.'/'.$this->id.'/';
        if(Str::startsWith($this->bgimage, 'http')) {
            return $this->bgimage;
        }
        else {
            return $url.'bgimage';
        }
    }

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }
}
