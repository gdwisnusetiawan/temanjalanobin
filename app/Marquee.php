<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    protected $table = 'marquee';
    public $timestamps = false;
    protected $connection = 'web';

    public function getMarqueetextAttribute($value)
    {
        return Functions::translate($value);
    }
}
