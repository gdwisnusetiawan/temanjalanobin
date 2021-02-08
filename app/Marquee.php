<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    protected $table = 'marquee';
    public $timestamps = false;
    protected $connection = 'web';
}
