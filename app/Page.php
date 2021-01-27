<?php

namespace App;

use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // protected $table = 'menu';
    public $timestamps = false;
    protected $connection = 'web';
    
    public function getPageTypeAttribute()
    {
        return 'single';
    }
    
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menuid', 'id');
    }

    public function getDatetimeFormatAttribute()
    {
        return Functions::datetimeFormat($this->datetime);
    }

    public function getMediaAttribute()
    {
        return Functions::media($this);
        // $table_columns = Functions::tableColumns($this);
        // $image_count = collect($table_columns)->filter(function ($value, $key) {
        //     return Str::contains($value, 'image');
        // })->count();
        // $images = [];
        // for ($i=1; $i <= $image_count; $i++) {
        //     if(is_file(asset($this->{'image'.$i}))) {
        //         $images[] = asset($this->{'image'.$i});
        //     }
        // }
        // $media['type'] = 'image';
        // $media['url'] = '';
        // if(isset($this->video)) {
        //     $media['type'] = 'video';
        //     $media['url'] = is_file(asset($this->video)) ? asset($this->video) : '';
        // }
        // elseif(isset($this->audio)) {
        //     $media['type'] = 'audio';
        //     $media['url'] = is_file(asset($this->audio)) ? asset($this->audio) : '';
        // }
        // else {
        //     $media['type'] = 'image';
        //     $media['url'] = $images;
        // }
        // return $media;
    }
}
