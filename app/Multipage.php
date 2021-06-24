<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Multipage extends Model
{
    // protected $table = 'menu';
    public $timestamps = false;
    protected $connection = 'web';

    public function getPageTypeAttribute()
    {
        return 'multiple';
    }

    public function scopeWhereSlug($query, $type)
    {
        return $query->where('slug', 'like', '%'.$type.'%');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menuid', 'id');
    }

    public function submultipages()
    {
        return $this->hasMany('App\Multisubpage', 'multipagesid', 'id');
    }

    public function getDatetimeFormatAttribute()
    {
        return Functions::datetimeFormat($this->datetime);
    }

    public function getMediaAttribute()
    {
        return Functions::media($this);
    }

    public function getContentPreviewAttribute()
    {
        return Functions::paragraphChunk($this->content);
    }

    public function getSlugAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getContentAttribute($value)
    {
        return Functions::translate($value);
    }
}
