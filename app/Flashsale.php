<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flashsale extends Model
{
    // protected $table = 'promotion';
    public $timestamps = false;
    protected $connection = 'web';
}
