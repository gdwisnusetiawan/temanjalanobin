<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subinventory extends Model
{
    protected $table = 'subinventory';
    public $timestamps = false;
    protected $connection = 'master';

    public function product()
    {
        return $this->belongsTo('App\Product', 'productid', 'id');
    }

    public function actor()
    {
        return $this->belongsTo('App\User', 'actorid', 'actorid');
    }
}
