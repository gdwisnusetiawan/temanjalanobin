<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';
    public $timestamps = false;
    protected $connection = 'master';

    public function location()
    {
        return $this->belongsTo('App\DistributorLocation', 'locid', 'id');
    }
}
