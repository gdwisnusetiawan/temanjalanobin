<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorLocation extends Model
{
    protected $table = 'distributorloc';
    public $timestamps = false;
    protected $connection = 'master';

    public function distributors()
    {
        return $this->hasMany('App\Distributor', 'locid', 'id');
    }
}
