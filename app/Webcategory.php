<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Webcategory extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    protected $connection = 'web';

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }
}
