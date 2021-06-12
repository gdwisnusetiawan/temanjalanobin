<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $table = 'ip';
    public $timestamps = false;
    protected $connection = 'pgsql';
}
