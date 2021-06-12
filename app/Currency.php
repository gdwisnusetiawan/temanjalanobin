<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    public $timestamps = false;
    protected $connection = 'master';

    public static function rateNominal()
    {
        $rupiah = Currency::whereRaw("LOWER(symbol) like '%rp%'")->first();
        $config = Config::first();
        if($config->flatrate) {
            $rate = $config->flatrate;
        }
        elseif(!$config->flatrate) {
            $rate = $rupiah->rate;
        }
        else {
            $rate = 0;
        }
        return $rate;
    }
}
