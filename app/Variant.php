<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = 'variant';
    public $timestamps = false;
    protected $connection = 'master';

    public function product()
    {
        $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function getOptionsListAttribute()
    {
        return explode(',', $this->options);
    }

    public function getInputNameAttribute()
    {
        return Str::slug($this->title, '_');
    }
}
