<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Multisubpage extends Model
{
    // protected $table = 'menu';
    public $timestamps = false;
    protected $connection = 'web';

    public function getPageTypeAttribute()
    {
        return 'multisubpage';
    }

    public function multipage()
    {
        return $this->belongsTo('App\Multipage', 'multipagesid', 'id');
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
}
