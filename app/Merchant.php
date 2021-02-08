<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'merchant';
    public $timestamps = false;
    protected $connection = 'paymentgateway';
}
