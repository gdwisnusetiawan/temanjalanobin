<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Flashsale extends Model
{
    // protected $table = 'promotion';
    public $timestamps = false;
    protected $connection = 'web';

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }
}
