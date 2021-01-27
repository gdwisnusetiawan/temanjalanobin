<?php

namespace App;

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
}
