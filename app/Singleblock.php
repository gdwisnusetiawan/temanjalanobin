<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Singleblock extends Model
{
    protected $table = 'singleblock';
    public $timestamps = false;
    protected $connection = 'web';

    public function getLinksAttribute()
    {
        if($this->link) {
            if(Str::startsWith($this->link, 'http')) {
                return $this->link;
            }
            else {
                return route('page.index', $this->link);
            }
        }
        else {
            return '#';
        }
    }

    public function getMediaAttribute()
    {
        return Functions::media($this);
    }

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Functions::translate($value);
    }
}
