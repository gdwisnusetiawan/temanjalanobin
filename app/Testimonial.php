<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';
    public $timestamps = false;
    protected $connection = 'web';

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }
}
