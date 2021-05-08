<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webcategory extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    protected $connection = 'web';
}
