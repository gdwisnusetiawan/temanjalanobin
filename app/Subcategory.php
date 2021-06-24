<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    public $timestamps = false;
    protected $connection = 'web';

    public function categories()
    {
        return $this->hasMany('App\Category', 'subcat', 'id');
    }

    public function categoryModel()
    {
        return $this->belongsTo('App\Category', 'category', 'id');
    }

    public function getSlugAttribute()
    {
        return $this->id;
    }

    public function getTitleAttribute()
    {
        return $this->name;
    }

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

    public function getNameAttribute($value)
    {
        return Functions::translate($value);
    }
}
