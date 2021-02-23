<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    public $timestamps = false;
    protected $connection = 'web';

    public function getLogoDarkAttribute()
    {
        $file = explode('.', $this->logo);
        // return $file[0].'-dark.'.$file[1];
        return $this->logo_url;
    }

    public function getLogoUrlAttribute()
    {
        return env('APP_STORAGE_URL').'foto/general/'.$this->id.'/logo';
    }

    public function getFaviconUrlAttribute()
    {
        return env('APP_STORAGE_URL').'foto/general/'.$this->id.'/favicon';
    }
}
